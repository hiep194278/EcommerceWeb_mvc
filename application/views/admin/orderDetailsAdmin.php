<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
    $ct = new Cart();

    $customerID = null;
    $orderdate = null;
    
    if (isset($_GET['customerid'])) {
        $customerID = $_GET['customerid'];
            if ( isset($_GET['timeorder']) ) {
            $orderdate = str_replace('x', ':', $_GET['timeorder']);
    
        }
    }
    else {
        echo '<a>Hi</a>';
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết đơn hàng</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: rgba(100, 100, 100, 0.5);
        }
    </style>
    <link rel="stylesheet" href="public/css/search.css" /> 
</head>

<body>
<form action="" method="POST">
    <h1 style='text-align: center;'>Chi tiết đơn hàng</h1>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php
            $tempSum = 0;
            $get_detail_bill = $ct->get_detail_bill($customerID,$orderdate);
            if ($get_detail_bill) { 
                $id = 0;        
                while ($result = $get_detail_bill->fetch_assoc()) {
                    $id++;
                    
        ?> 
        <tr>
            <td><?php echo $id ?></td>
            <td><img src="public/uploads/<?php echo $result['productImage'] ?>" height="120" width="140"></td>
            <td><?php echo $result['productName'] ?></td>
            <td><?php echo number_format($result['price'], 0, ',', '.'); ?>₫</td>
            <td><?php echo $result['quantity'] ?></td>
            <td><?php 
                $total = $result['price'] * $result['quantity'];
                echo number_format($total, 0, ',', '.');
            ?>₫</td>
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

</form>
</body>
</html>