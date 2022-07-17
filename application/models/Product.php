<?php

require_once ROOT . DS . 'application' . DS . 'models' . DS . 'BaseModel.php';

class Product extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }
    
    public function insert_product($data, $files)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $featured = mysqli_real_escape_string($this->db->link, $data['featured']);

        //Handle image
        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $featured=="" || empty($file_name)) {
            $alert = "<span style='color:red;'>Không được nhập trường trống</span>";
            return $alert;
        } else {
            if ($file_size > 5242880) {
                $alert = "<span style='color:red;'>File ảnh nên nhỏ hơn 5MB</span>";
                return $alert;
            } elseif (in_array($file_ext, $permitted) == false) {
                $alert = "<span style='color:red;'>Định dạng file không hợp lệ, sử dụng: " . implode(', ', $permitted) . "</span>";
                return $alert;
            }

            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName, brandID, catID, product_desc, featured, price, product_image) VALUES('$productName', '$brand', '$category', '$product_desc', '$featured', '$price', '$unique_image')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span style='color:green;'>Thêm thành công</span>";
            } else {
                $alert = "<span style='color:red;'>Thêm thất bại</span>";
            }
            
            return $alert;
        }
    }

    public function show_product() {
        $query = "
            SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catID = tbl_category.catID
            INNER JOIN tbl_brand ON tbl_product.brandID = tbl_brand.brandID
            order by tbl_product.productID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_product_admin($data) {
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $keyword = $this->fm->validation($data['keyword']);
        $fromPrice = $this->fm->validation($data['from_price']);
        $toPrice = $this->fm->validation($data['to_price']);

        $query = "
            SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catID = tbl_category.catID
            INNER JOIN tbl_brand ON tbl_product.brandID = tbl_brand.brandID
            WHERE tbl_product.productName LIKE '%$keyword%' AND tbl_product.catID LIKE '$category' AND tbl_product.brandID LIKE '$brand' AND tbl_product.price >= $fromPrice AND tbl_product.price <= $toPrice 
            order by tbl_product.productID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data, $files, $id) {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $featured = mysqli_real_escape_string($this->db->link, $data['featured']);
        $old_image = mysqli_real_escape_string($this->db->link, $data['old_image']);

        //Handle image
        $permitted = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName=="" || $brand=="" || $category=="" || $product_desc=="" || $price=="" || $featured=="") {
            $alert = "<span style='color:red;'>Không được nhập danh mục trống</span>";
        } else {
            if (!empty($file_name)) {
                
                if ($file_size > 5242880) {
                    $alert = "<span style='color:red;'>File ảnh nên nhỏ hơn 5MB</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permitted) == false) {
                    $alert = "<span style='color:red;'>Định dạng file không hợp lệ, sử dụng: " . implode(', ', $permitted) . "</span>";
                    return $alert;
                }

                move_uploaded_file($file_temp, $uploaded_image);
                unlink("uploads/" . $old_image);
                $query = "UPDATE tbl_product SET
                            productName = '$productName',
                            brandID = '$brand',
                            catID = '$category',
                            featured = '$featured',
                            price = '$price',
                            product_image = '$unique_image',
                            product_desc = '$product_desc'
                            WHERE productID = '$id'";
            } else {
                $query = "UPDATE tbl_product SET
                            productName = '$productName',
                            brandID = '$brand',
                            catID = '$category',
                            featured = '$featured',
                            price = '$price',
                            product_desc = '$product_desc'
                            WHERE productID = '$id'";
            }

            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span style='color:green;'>Sửa thành công</span>";
            } else {
                $alert = "<span style='color:red;'>Sửa thất bại</span>";
            }               
        }   

        return $alert;         
    }

    public function delete_product($id, $old_image) {
        $query = "DELETE FROM tbl_product WHERE productID = '$id'";
        $result = $this->db->delete($query);
        unlink("uploads/" . $old_image);
        
        if ($result) {
            $alert = "<span style='color:green;'>Xóa thành công</span>";
        } else {
            $alert = "<span style='color:red;'>Xóa thất bại</span>";
        }

        return $alert;         
    }

    public function getproductbyID($id) {
        $query = "SELECT * FROM tbl_product where productID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_featured_products() {
        $query = "SELECT * FROM tbl_product WHERE featured = '1'";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_new_products() {
        $query = "SELECT * FROM tbl_product order by productID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function get_details($id) {
        $query = "
            SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            FROM tbl_product INNER JOIN tbl_category ON tbl_product.catID = tbl_category.catID
            INNER JOIN tbl_brand ON tbl_product.brandID = tbl_brand.brandID
            WHERE tbl_product.productID = '$id'";
            
        $result = $this->db->select($query);
        return $result;
    }

    public function insert_wishlist($productID, $customerID) {
        $productID = mysqli_real_escape_string($this->db->link, $productID);
        $customerID = mysqli_real_escape_string($this->db->link, $customerID);

        $checkDuplicate = "SELECT * FROM tbl_wishlist WHERE productID = '$productID' AND customerID = '$customerID'";
        $result = $this->db->select($checkDuplicate);
        if ($result) {
            $alert = "<span style='color:red;'>Đã được thêm vào Wishlist</span>";
            return $alert;
        }


        $query = "SELECT * FROM tbl_product WHERE productID = '$productID'";
        $result = $this->db->select($query)->fetch_assoc();

        $productName = $result['productName'];
        $price = $result['price'];
        $productImage = $result['product_image'];

        $query = "INSERT INTO tbl_wishlist(productID, price, productImage, customerID, productName)
                    VALUES ('$productID', '$price', '$productImage', '$customerID', '$productName')";
        $result = $this->db->insert($query);

        if ($result) {
            $alert = "<span style='color:green;'>Thêm vào Wishlist thành công</span>";
        } else {
            $alert = "<span style='color:red;'>Thêm thất bại</span>";
        }

        return $alert;
    }

    public function get_wishlist($customerID) {
        $query = "SELECT * FROM tbl_wishlist WHERE customerID = '$customerID' order by productID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function del_wishlist_item($productID, $customerID) {
        $query = "DELETE FROM tbl_wishlist WHERE customerID = '$customerID' AND productID = '$productID'";
        $result = $this->db->delete($query);
        return $result;
    }

    public function search_product($data) {
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $keyword = $this->fm->validation($data['keyword']);
        $fromPrice = $this->fm->validation($data['from_price']);
        $toPrice = $this->fm->validation($data['to_price']);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$keyword%' AND catID LIKE '$category' AND brandID LIKE '$brand' AND price >= $fromPrice AND price <= $toPrice";
        $result = $this->db->select($query);

        return $result;
    }

    public function get_products_by_category($catID) {
        $query = "SELECT * FROM tbl_product WHERE catID = '$catID'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>