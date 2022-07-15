<?php

require_once ROOT . DS . 'application' . DS . 'models' . DS . 'BaseModel.php';

class Brand extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }
    
    public function insert_brand($brandName)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $alert = "<span style='color:red;'>Không được nhập thương hiệu trống</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
            $result = $this->db->insert($query);

            if ($result) {
                $alert = "<span style='color:green;'>Thêm thành công</span>";
            } else {
                $alert = "<span style='color:red;'>Thêm thất bại</span>";
            }
            
            return $alert;
        }
    }

    public function show_brand() {
        $query = "SELECT * FROM tbl_brand order by brandID desc";
        $result = $this->db->select($query);
        return $result;
    }

    public function search_brand_admin($data) {
        $keyword = $this->fm->validation($data['keyword']);
        $query = "SELECT * FROM tbl_brand WHERE brandName LIKE '%$keyword%'";
        $result = $this->db->select($query);

        return $result;
    }

    public function update_brand($brandName, $id) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brandName)) {
            $alert = "<span style='color:red;'>Không được nhập thương hiệu trống</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandID = '$id'";
            $result = $this->db->update($query);

            if ($result) {
                $alert = "<span style='color:green;'>Sửa thành công</span>";
            } else {
                $alert = "<span style='color:red;'>Sửa thất bại</span>";
            }

            return $alert;
            
        }            
    }

    public function delete_brand($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "DELETE FROM tbl_brand WHERE brandID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span style='color:green;'>Xóa thành công</span>";
        } else {
            $alert = "<span style='color:red;'>Xóa thất bại</span>";
        }

        return $alert;         
    }

    public function getbrandbyID($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM tbl_brand where brandID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
}
