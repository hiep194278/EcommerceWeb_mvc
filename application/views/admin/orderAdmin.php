<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php';
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Customer.php';
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
?>

<?php
    $get_order_period = null;
    $from_date = null;
    $to_date = null;
    $cart = new Cart();
    if (isset($_GET['shiftCustomerID'])) {
        $id = $_GET['shiftCustomerID'];
        $time = $_GET['time'];
        $result = $cart->shifted($id, $time);
    }

    if (isset($_GET['deleteCustomerID'])) {
        $id = $_GET['deleteCustomerID'];
        $time = $_GET['time'];
        $del_result = $cart->delete_shifted($id, $time);
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];
        $get_order_period = $cart->get_order_cart_period($from_date, $to_date);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Các đơn đặt hàng</title>
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
    <form action="orderAdmin" method="post">
        Chọn thời gian: Từ
          <input type="date" name="from_date" id="from_date" value = 
              <?php
                if(isset($from_date))
                {
                    echo $from_date;
                }
              ?>
                 />
          đến 
          <input type="date" name="to_date" id="to_date" value = 
              <?php
                if(isset($to_date))
                {
                    echo $to_date;
                }
              ?>
                 />
          <input type="submit" name="statistic_button" value="Thống kê"/>
    </form>
    <br><br>
    <?php
        if (isset($result)) {
            echo $result;
        }
        if (isset($del_result)) {
            echo $del_result;
        }
    ?>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Thời điểm</th>
            <th>Thông tin đơn hàng</th>
            <th>ID khách hàng</th>
            <th>Thông tin khách mua</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $cart = new Cart();
            if(!isset($get_order_period))
            {
                $get_order = $cart->get_order_cart();
            }
            else
            {
                $get_order = $get_order_period;
            }
           
            if ($get_order) {
                $i = 0;
                while ($result = $get_order->fetch_assoc()) {
                    $i++;
        ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $result['orderDate'] ?></td>
            <td>
                <a href="orderDetailsAdmin&customerid=<?php echo $result['customerID'] ?>&timeorder=<?php echo str_replace(':', 'x', $result['orderDate']);?>">
                    Hiện thông tin
                </a>
            </td>
            <td><?php echo $result['customerID'] ?></td>
            <td><a><?php
                        $cus = new Customer();
                        $res = $cus->show_customer($result['customerID']);
                        if($res)
                        {
                            $resultName = $res->fetch_assoc();
                        }
                        echo $resultName['customerName'];
                    ?>  
                </a>||<a href="customerInformationAdmin&customerid=<?php echo $result['customerID'] ?>"> Hiện thông tin</a></td>
            <td>
                <?php
                if ($result['orderStatus'] == '0') {
                ?>
                    <a href="orderAdmin&shiftCustomerID=<?php echo $result['customerID'] ?>&time=<?php echo str_replace(':', 'x', $result['orderDate']); ?>">Xử lý</a>                    
                <?php 
                } elseif ($result['orderStatus'] == '1') {
                    echo 'Đang giao hàng';                      
                } else {
                ?>
                    <a href="orderAdmin&deleteCustomerID=<?php echo $result['customerID'] ?>&time=<?php echo str_replace(':', 'x', $result['orderDate']); ?>">
                    Xóa
                    </a>                    
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
</body>
</html>