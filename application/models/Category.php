<?php

require_once ROOT . DS . 'application' . DS . 'models' . DS . 'BaseModel.php';

class Category extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }
    
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $alert = "<span style='color:red;'>Không được nhập danh mục trống</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span style='color:green;'>Thêm thành công</span>";
            } else {
                $alert = "<span style='color:red;'>Thêm thất bại</span>";
            }
            
            return $alert;
        }
    }

    public function show_category() {
        $query = "SELECT * FROM tbl_category order by catID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catName, $id) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $alert = "<span style='color:red;'>Không được nhập danh mục trống</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catID = '$id'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span style='color:green;'>Sửa thành công</span>";
            } else {
                $alert = "<span style='color:red;'>Sửa thất bại</span>";
            }

            return $alert;
            
        }            
    }

    public function search_category_admin($data) {
        $keyword = $this->fm->validation($data['keyword']);
        $query = "SELECT * FROM tbl_category WHERE catName LIKE '%$keyword%'";
        $result = $this->db->select($query);

        return $result;
    }

    public function delete_category($id) {
        $query = "DELETE FROM tbl_category WHERE catID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span style='color:green;'>Xóa thành công</span>";
        } else {
            $alert = "<span style='color:red;'>Xóa thất bại</span>";
        }

        return $alert;         
    }

    public function getcatbyID($id) {
        $query = "SELECT * FROM tbl_category where catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
