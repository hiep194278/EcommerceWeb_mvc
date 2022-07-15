<?php

include_once ROOT . DS . 'library' . DS . 'Session.php';
Session::checkLoginAdmin();
require_once ROOT . DS . 'application' . DS . 'models' . DS . 'BaseModel.php';

class AdminLogin extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }
    
    public function login_admin($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);
        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $alert = "Không được nhập tài khoản hoặc mật khẩu trống";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('adminLogin', true);
                Session::set('adminID', $value['adminID']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                header('Location:homeAdmin');
            } else {
                $alert = "Tài khoản hoặc mật khẩu đã nhập không hợp lệ";
                return $alert;
            }
        }
    }
}
