<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="public/css/cart.css" />
    <style>
        img.checkout {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 25%;
        }
    </style> 
</head>
<body>
    <div style='min-height:100%'>
    <?php 
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
        $cart = new Cart;  
      
        if (isset($_GET['delID'])) {
            $cartID = $_GET['delID'];
            $deleteItem = $cart->del_item_cart($cartID);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $quantity = $_POST['buynumber'];
            $cartID = $_POST['cartID'];
            $updateQuantity = $cart->update_quantity($quantity, $cartID);
        }

        if (isset($_GET['orderid'])) {
            $customerID = Session::get('customer_id');
            $insertOrder = $cart->insert_order($customerID);
            $delCart = $cart->del_cart_data();
            header('Location:payment');
        }
    ?>
    
    <h1 style='text-align: center;'>GIỎ HÀNG</h1>
    <?php
        if (isset($updateQuantity)) {
            echo $updateQuantity;
        }

        if (isset($deleteItem)) {
            echo $deleteItem;
        }
    ?>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $getCart = $cart->get_product_cart();
            $tempSum = 0;
            
            if ($getCart) {  
                $id = 0; 
                $tempSum = 0;    
                while ($result = $getCart->fetch_assoc()) {
                    $id = $id + 1; 
                    
        ?> 
        <tr>
            <td><?php echo $id ?></td>
            <td><img src="public/uploads/<?php echo $result['productImage'] ?>" height="120" width="140"></td>
            <td><?php echo $result['productName'] ?></td>
            <td><?php echo number_format($result['price'], 0, ',', '.'); ?>₫</td>
            <td>
                <form action='' method='POST'>
                    <input type='hidden' name='cartID' value='<?php echo $result['cartID'] ?>'/>
                    <input type='number' min='1' name='buynumber' value='<?php echo $result['quantity'] ?>'/>
                    <input type='submit' name='submit' value='Cập nhật'/>
                </form>
                </td>
            <td><?php 
                $total = $result['price'] * $result['quantity'];
                echo number_format($total, 0, ',', '.');
            ?>₫</td>
            <td>
                <a onClick="return confirm('Bạn có muốn xóa sản phẩm khỏi giỏ hàng?')" href="cart&delID=<?php echo $result['cartID']?>">Xóa</a>
            </td>
        </tr>
        <?php
                    $tempSum += $total;
                }
            }
        ?>
    </table>

    <h1 style='text-align: center;'>TỔNG</h1>

    <table>
        <tr>
            <td>Tạm tính:</td>
            <td> 
                <?php echo number_format($tempSum, 0, ',', '.');?>₫
            </td>
        </tr>
        <tr>
            <td>VAT:</td>
            <td> 
                10%
            </td>
        </tr>
        <tr>
            <td>Thành tiền:</td>
            <?php
                $finalSum = $tempSum + $tempSum * 0.1;
            ?>
            <td> 
                <?php echo number_format($finalSum, 0, ',', '.');?>₫
            </td>
        </tr>
    </table>

    <br>

    <?php
        if ($tempSum > 0) {
            echo '<a href="cart&orderid=order"><img src="public/images/payment.png" alt="payment_pic" class="checkout"></a>';
        }
    ?>

    </div>
</body>
</html>