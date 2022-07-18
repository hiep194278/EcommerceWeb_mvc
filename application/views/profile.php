<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="public/css/login.css" />
</head>
<body>
<div style='min-height:100%'>
    <?php 
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
        $cart = new Cart;  

        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Customer.php';
        $customer = new Customer;

        $login_check = Session::get('customer_login');
        if ($login_check == false) {
            header('Location:login');
        } 
    
        $id = Session::get('customer_id');
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            $updateCustomer = $customer->update_customer($_POST, $id);
        }

        $id = Session::get('customer_id');
        $get_customer = $cart->show_customer($id);
        if ($get_customer) {
            while ($result = $get_customer->fetch_assoc()) {
    ?>

    <h2 style="text-align: center">HỒ SƠ NGƯỜI DÙNG</h2>
    <form action="" method="post" class="log-form">
        <div class="container">
            <label><b>Tên của bạn</b></label>
            <input type="text" placeholder="Nhập tên" name="name" value="<?php echo $result['customerName']; ?>" required>

            <label><b>Địa chỉ</b></label>
            <input type="text" placeholder="Địa chỉ của bạn" name="address" value="<?php echo $result['customerAddress']; ?>" required>
            
            <label><b>Số điện thoại</b></label>
            <input type="text" placeholder="Điện thoại" name="phone" value="<?php echo $result['phone']; ?>" required>

            <label><b>Email</b></label>
            <input type="text" placeholder="Email" name="email" value="<?php echo $result['email']; ?>" required>
  
            <?php   
                if (isset($updateCustomer)) {
                    echo $updateCustomer;
                }
            ?>

            <input type="submit" name="update" value="Cập nhật"/>
        </div>
    </form>
    <?php
            }
        }
    ?>
    </div>
</body>
</html>