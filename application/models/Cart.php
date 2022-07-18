<?php

require_once ROOT . DS . 'application' . DS . 'models' . DS . 'BaseModel.php';

class Cart extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }
    
    public function add_to_cart($quantity, $id) 
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $sessionID = session_id();

        $query = "SELECT * FROM tbl_product WHERE productID = '$id'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result["product_image"];
        $price = $result["price"];
        $productName = $result["productName"];
    
        $check_cart = "SELECT * FROM tbl_cart WHERE productID='$id' AND sessionID='$sessionID'";
        $check_cart = $this->db->select($check_cart);
        if ($check_cart) {
            $alert = "<span style='color:red;'>Sản phẩm đã ở trong giỏ hàng</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_cart(productID, sessionID, productName, price, quantity, productImage) 
                    VALUES('$id', '$sessionID', '$productName', '$price', '$quantity', '$image')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span style='color:green;'>Thêm thành công</span>";
                return $alert;
            } else {
                header("Location:details&productid='$id'");
            }
        }
    }

    public function get_product_cart() 
    {
        $sessionID = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionID='$sessionID'";
        $result = $this->db->select($query);

        return $result;
    }

    public function update_quantity($quantity, $cartID) {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartID = mysqli_real_escape_string($this->db->link, $cartID);
        $query = "UPDATE tbl_cart SET
                    quantity = '$quantity'
                    WHERE cartID = '$cartID'";
        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span style='color:green;'>Sửa thành công</span>";
        } else {
            $alert = "<span style='color:red;'>Sửa thất bại</span>";
        } 

        return $alert;
    }

    public function del_item_cart($cartID) {
        $cartID = mysqli_real_escape_string($this->db->link, $cartID);
        $query = "DELETE FROM tbl_cart WHERE cartID='$cartID'";
        $result = $this->db->delete($query);
        if ($result) {
            header('Location:cart');
        } else {
            $alert = "<span style='color:red;'>Sửa thất bại</span>";
            return $alert;
        } 
    }

    public function del_cart_data() {
        $sessionID = session_id();
        $query = "DELETE FROM tbl_cart WHERE sessionID='$sessionID'";
        $result = $this->db->select($query);

        return $result;
    }

    public function show_customer($id) {
        $query = "SELECT * FROM tbl_customer WHERE customerID='$id'";
        $result = $this->db->select($query);

        return $result;
    }

    public function insert_order($customer_id) {
        $sessionID = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sessionID = '$sessionID'";
        $getProduct = $this->db->select($query);

        if ($getProduct) {
            while ($result = $getProduct->fetch_assoc()) {
                $productID = $result['productID'];
                $productName = $result['productName'];
                $customerID = $customer_id;
                $quantity = $result['quantity'];
                $price = $result['price'];
                $productImage = $result['productImage'];
                $query = "INSERT INTO tbl_order(productID, productName, customerID, quantity, price, productImage)
                            VALUES('$productID', '$productName', '$customerID', '$quantity', '$price', '$productImage')";
                $insertOrder = $this->db->insert($query);
            }
        }
    }

    public function get_order_history($customerID) {
        $query = "SELECT * FROM tbl_order WHERE customerID='$customerID'";
        $result = $this->db->select($query);
        
        return $result;
    }

    public function get_order_cart() {
//            $query = "SELECT * FROM tbl_order ORDER BY orderDate";
//            $result = $this->db->select($query);
//            
//            return $result;
        $query = "SELECT DISTINCT orderDate, orderStatus,customerID FROM tbl_order ORDER BY orderDate";
        $result = $this->db->select($query);
        
        return $result;
    }
    
    public function get_order_cart_by_customer_id($id) {
    //  $query = "SELECT * FROM tbl_order ORDER BY orderDate";
    //  $result = $this->db->select($query);
    //            
    //  return $result;
        $query = "SELECT DISTINCT orderDate, orderStatus,customerID FROM tbl_order WHERE customerID = '$id' ORDER BY orderDate";
        $result = $this->db->select($query);
        
        return $result;
    }
    
    public function get_order_cart_period($from_date, $to_date) {
    //  $query = "SELECT * FROM tbl_order ORDER BY orderDate";
    //  $result = $this->db->select($query);
    //            
    //  return $result;
        $query = "SELECT DISTINCT orderDate, orderStatus,customerID FROM tbl_order WHERE orderDate > '$from_date' AND orderDate < '$to_date' ORDER BY orderDate";
        $result = $this->db->select($query);

        return $result;
    }

    public function shifted($id, $time) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $time = str_replace('x', ':', $time);
        $query = "UPDATE tbl_order SET orderStatus = '1' WHERE customerID='$id' AND orderDate='$time'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color:green;'>Xử lý thành công</span>";
        } else {
            $alert = "<span style='color:green;'>Xử lý thất bại</span>";
        }

        return $alert;
    }

    public function delete_shifted($id, $time) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $time = str_replace('x', ':', $time);
        $query = "DELETE FROM tbl_order WHERE customerID='$id' AND orderDate='$time'";
        $result = $this->db->delete($query);

        if ($result) {
            $alert = "<span style='color:green;'>Xóa thành công</span>";
        } else {
            $alert = "<span style='color:green;'>Xóa thất bại</span>";
        }

        return $alert;
    }

    public function order_confirm($id, $time) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);

        $query = "UPDATE tbl_order SET orderStatus = '2' WHERE customerID='$id' AND orderDate='$time'";
        $result = $this->db->update($query);

        if ($result) {
            $alert = "<span style='color:green;'>Xóa thành công</span>";
        } else {
            $alert = "<span style='color:green;'>Xóa thất bại</span>";
        }

        return $alert;            
    }
    
    public function get_detail_bill($customerID, $timeorder)
    {
        $customerID = mysqli_real_escape_string($this->db->link, $customerID);
        $timeorder = mysqli_real_escape_string($this->db->link, $timeorder);
        $query = "SELECT * FROM tbl_order WHERE customerID = '$customerID' AND orderDate = '$timeorder'";
        $result = $this->db->select($query);

        return $result;
    }
    public function get_all_sold_product_with_period($from_date, $to_date)
    {
        $query = "SELECT distinct productID, productName FROM tbl_order WHERE orderDate > '$from_date' AND orderDate < '$to_date' AND orderStatus = '2'";
        $result = $this->db->select($query);

        return $result;
    }
    public function get_all_sold_product()
    {
        $query = "SELECT distinct productID, productName FROM tbl_order WHERE orderStatus = '2'";
        $result = $this->db->select($query);

        return $result;
    }
    public function get_count_sold_product_with_period($id,$from_date, $to_date)
    {
        $query = "SELECT sum(quantity) as cnt FROM tbl_order WHERE orderDate > '$from_date' AND orderDate < '$to_date' AND productID = '$id' AND orderStatus = '2'";
        $result = $this->db->select($query);

        return $result;
    }
    public function get_count_sold_product($id)
    {
        $query = "SELECT sum(quantity) as cnt FROM tbl_order WHERE productID = '$id' AND orderStatus = '2'";
        $result = $this->db->select($query);

        return $result;
    }
}
