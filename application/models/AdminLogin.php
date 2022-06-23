<?php
    require_once ROOT . DS . 'library' . DS . 'Session.php';
    Session::checkLogin();
    require_once ROOT . DS . 'library' . DS . 'Database.php';
    require_once ROOT . DS . 'helpers' . DS . 'Format.php';
?>

<?php
    class AdminLogin 
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
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
                    header('Location:index.php');
                } else {
                    $alert = "Tài khoản hoặc mật khẩu đã nhập không hợp lệ";
                    return $alert;
                }
            }
        }
    }
?>