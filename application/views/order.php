<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="public/css/cart.css" /> 
</head>

<body>
<div style='min-height:100%'>
    <?php 
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
        $cart = new Cart;  
        
        $checkLogin = Session::get('customer_id');
        if ($checkLogin == false) {
            header('Location:login');
        }
        
        if (isset($_GET['confirmid'])) {
            $id = $_GET['confirmid'];
            $time = str_replace('x', ':', $_GET['time']);
            $del_result = $cart->order_confirm($id, $time);
        }
    ?>
   
    <form action="" method="POST">
    <h1 style='text-align: center;'>LỊCH SỬ ĐẶT HÀNG</h1>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Chi tiết đơn hàng</th>
            <th>Thời điểm</th>
            <th>Trạng thái</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $customerID = Session::get('customer_id');
            $getOrderHistory = $cart->get_order_cart_by_customer_id($customerID);
            $tempSum = 0;
            if ($getOrderHistory) { 
                $id = 0;        
                while ($result = $getOrderHistory->fetch_assoc()) {
                    $id++;
                    
        ?> 
        <tr>
            <td><?php echo $id ?></td>
            <td><a href="orderDetails&timeorder=<?php echo str_replace(':', 'x', $result['orderDate']); ?>">Hiện thông tin</a>
            </td>
            <td><?php echo $result['orderDate'] ?></td>
            <td>
                <?php 
                if ($result['orderStatus'] == '0') {
                    echo 'Đang xử lý';
                } elseif ($result['orderStatus'] == '1') {
                ?>
                Đang giao hàng
                <?php
                } else {
                    echo 'Đã nhận hàng';
                }
                ?>
            </td>
            <td><?php 
                if ($result['orderStatus'] == '0') {
                    echo 'N/A';
                } elseif ($result['orderStatus'] == '1') {
                ?>
                    <a href="order&confirmid=<?php echo $result['customerID'] ?>&time=<?php echo str_replace(':', 'x', $result['orderDate']) ?>">Xác nhận đã lấy hàng</a>
                <?php
                } else {
                ?>
                    Đơn hàng đã được xử lý xong
                <?php
                }
                ?>
            </td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
    </form>
    </div>
</body>
</html>