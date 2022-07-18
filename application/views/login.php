<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
<div style='min-height:100%'>
    <?php
        $login_check = Session::get('customer_login');
        if ($login_check) {
            header('Location:home');
        }

        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Customer.php';
        $customer = new Customer;

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))
            $insertCustomer = $customer->insert_customer($_POST);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
            $loginCustomer = $customer->login_customer($_POST);
    
    ?>
    
    <h2 style="text-align: center">ĐĂNG NHẬP VÀO HỆ THỐNG</h2>

    <form action="" method="post" class="log-form">
        <div class="container">
            <label><b>Tên tài khoản</b></label>
            <input type="text" placeholder="Email của bạn" name="email" required>
            <label><b>Mật khẩu</b></label>
            <input type="password" placeholder="Nhập mật khẩu" name="password" required>
            <?php
                if (isset($loginCustomer)) {
                    echo $loginCustomer;
                }
            ?>
            <input type="submit" name="login" value="Đăng nhập"/>
        </div>
    </form>

    <br>

    <h2 style="text-align: center">HOẶC ĐĂNG KÝ NẾU BẠN CHƯA CÓ TÀI KHOẢN</h2>
    <form action="" method="post" class="log-form">
        <div class="container">
            <label><b>Tên của bạn</b></label>
            <input type="text" placeholder="Nhập tên" name="name" required>

            <label><b>Địa chỉ</b></label>
            <input type="text" placeholder="Địa chỉ của bạn" name="address" required>
            
            <label><b>Số điện thoại</b></label>
            <input type="text" placeholder="Điện thoại" name="phone" required>

            <label><b>Email</b></label>
            <input type="text" placeholder="Email" name="email" required>
                
            <label><b>Mật khẩu</b></label>
            <input type="password" placeholder="Nhập mật khẩu" name="password" required>
            <?php
                if (isset($insertCustomer)) {
                    echo $insertCustomer;
                }
            ?>
            <input type="submit" name="submit" value="Đăng ký"/>
        </div>
    </form>
    </div>
</body>
</html>