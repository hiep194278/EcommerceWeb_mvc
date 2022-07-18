<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="public/css/header.css">
</head>

<body>     
    <?php 
        global $project_path;

        require_once ROOT . DS . 'library' . DS . 'Session.php';
        Session::init();

        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
        $cart = new Cart;
    ?>

    <div class="topnav">
        <a href=<?php echo "/" . $project_path . "/" ?>>TRANG CHỦ</a>
        <a href=<?php echo "/" . $project_path . "/" . "products" ?>>SẢN PHẨM</a>
    
    <div class="user-menu">
        <?php
            if (isset($_GET['customerid'])) {
                $customerID = $_GET['customerid'];
                $delCart = $cart->del_cart_data();
                Session::destroy();
            }

            $login_check = Session::get('customer_login');
            if ($login_check == false) {
        ?>
                <a href=<?php echo "/" . $project_path . "/" . "login" ?>>ĐĂNG NHẬP</a>
        <?php
            } else {
        ?>
                <a href=<?php echo "/" . $project_path . "/" . "wishlist" ?>>WISHLIST</a>
                <a href=<?php echo "/" . $project_path . "/" . "order" ?>>ĐƠN HÀNG</a>
                <a href=<?php echo "/" . $project_path . "/" . "profile" ?>>HỒ SƠ</a>
                <a href=<?php echo "/" . $project_path . "/" . "cart" ?>>GIỎ HÀNG</a>
                <a href="home&customerid=<?php echo Session::get('customer_id') ?>">ĐĂNG XUẤT</a>
        <?php
            }
        ?>
    </div>
    </div>

</body>
</html>
