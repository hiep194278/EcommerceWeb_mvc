<?php

require_once ROOT . DS . 'application' . DS . 'models' . DS . 'BaseModel.php';

class Customer extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function insert_customer($data) {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name=="" || $address=="" || $phone=="" || $email=="" || $password=="") {
            $alert = "<span style='color:red;'>Không được nhập danh mục trống</span>";
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span style='color:red;'>Email đã tồn tại</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer(customerName, customerAddress, phone, email, customerPassword) 
                            VALUES('$name', '$address', '$phone', '$email', '$password')";               
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span style='color:green;'>Đăng ký thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span style='color:red;'>Đăng ký thất bại</span>";
                    return $alert;
                }
            }
        }

        return $alert; 
    }

    public function login_customer($data) {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        
        if ($email=="" || $password=="") {
            $alert = "<span style='color:red;'>Không được nhập danh mục trống</span>";
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email='$email' AND customerPassword='$password' LIMIT 1";
            $result_check = $this->db->select($check_email);

            if ($result_check) {
                $value = $result_check->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['customerID']);
                Session::set('customer_name', $value['customerName']);
                header('Location:home');
            } else {
                $alert = "<span style='color:red;'>Email hoặc mật khẩu không trùng khớp</span>";
            }
        }

        return $alert;
    }

    public function update_customer($data, $id) {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        
        if ($name=="" || $address=="" || $phone=="" || $email=="") {
            $alert = "<span style='color:red;'>Không được nhập danh mục trống</span>";
        } else {       
            $query = "UPDATE tbl_customer 
                        SET customerName='$name', customerAddress='$address', phone='$phone', email='$email'
                        WHERE customerID='$id'";               
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span style='color:green;'>Cập nhật thành công</span>";
                return $alert;
            } else {
                $alert = "<span style='color:red;'>Cập nhật thất bại</span>";
                return $alert;
            }               
        }
    }

    public function show_customer($id) {
        $query = "SELECT * FROM tbl_customer WHERE customerID='$id'";
        $result = $this->db->select($query);

        return $result;
    }

    public function show_all_customers() {
        $query = "SELECT * FROM tbl_customer";
        $result = $this->db->select($query);

        return $result;
    }

    public function delete_customer($id) {
        $query = "DELETE FROM tbl_customer WHERE customerID = '$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span style='color:green;'>Xóa thành công</span>";
        } else {
            $alert = "<span style='color:red;'>Xóa thất bại</span>";
        }

        return $alert;         
    }

    public function search_customer_admin($data) {
        $keywordID = $this->fm->validation($data['keywordID']);
        $keywordName = $this->fm->validation($data['keywordName']);
        $keywordAddress = $this->fm->validation($data['keywordAddress']);
        $keywordPhone = $this->fm->validation($data['keywordPhone']);
        $keywordEmail = $this->fm->validation($data['keywordEmail']);
        $query = "SELECT * FROM tbl_customer WHERE customerID LIKE '%$keywordID%' 
                                                AND customerName LIKE '%$keywordName%' 
                                                AND customerAddress LIKE '%$keywordAddress%' 
                                                AND phone LIKE '%$keywordPhone%'
                                                AND email LIKE '%$keywordEmail%'";
        $result = $this->db->select($query);

        return $result;
    }
}
