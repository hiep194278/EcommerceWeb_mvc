
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng nhập quản trị viên</title>
        <link rel="stylesheet" href="public/css/login.css" />
    </head>
    
    <body>
        <?php
            require_once ROOT . DS . 'application' . DS . 'models' . DS . 'AdminLogin.php'; 
            $class = new AdminLogin();
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $adminUser = $_POST['adminUser'];
                $adminPass = md5($_POST['adminPass']);
                $login_check = $class->login_admin($adminUser, $adminPass);
            }
        ?>

        <h2 style="text-align: center">ĐĂNG NHẬP DÀNH CHO QUẢN TRỊ VIÊN</h2>
        <form action="loginAdmin" method="post" class="log-form">
            <span style="color:red">
                <?php
                    if (isset($login_check)) {
                        echo $login_check;
                    }
                ?>
            </span>
            <div class="container">
                <label><b>Tên tài khoản</b></label>
                <input type="text" placeholder="Nhập tên tài khoản" name="adminUser" required/>

                <label><b>Mật khẩu</b></label>
                <input type="password" placeholder="Nhập mật khẩu" name="adminPass" required/>
                    
                <input type="submit" name="login" value="Đăng nhập">
            </div>
        </form>
    </body>
</html>