<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php'; 
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Customer.php';
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
?>

<?php
    $get_order_period = null;
    $from_date = null;
    $to_date = null;
    $cart = new Cart(); 
    $total_price = 0;
    $product = new Product();
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
    <link rel="stylesheet" href="css/search.css" /> 
</head>

<body>
    <form action="revenueAdmin" method="post">
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
            <th>Tên Mặt Hàng</th>
            <th>Thông tin mặt hàng</th>
            <th>Giá</th>
            <th>Số lượng bán ra</th>
            <th>Tổng tiền</th>
        </tr>
        <?php
            $cart = new Cart();
            $price = 0;
            $count = 0;
            if($from_date == null)
            {
                $get_product_name = $cart->get_all_sold_product();
            }
            else {
                $get_product_name = $cart->get_all_sold_product_with_period($from_date, $to_date);
            }
            if ($get_product_name) {
                $i = 0;
                while ($result = $get_product_name->fetch_assoc()) {
                    $i++;
        ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $result['productName'] ?></td>
            <td><a href="productDetailsAdmin&productid=<?php echo $result['productID'] ?>">Hiện thông tin</a></td>
            <td><?php
              
                    $product_detail = $product->getproductbyID($result['productID']);
                    $result_detail = $product_detail->fetch_assoc();
                    $price= $result_detail['price'];
                    echo number_format($price, 0, ',', '.');
                ?><a>₫</a></td>
            <td><?php
                        if($from_date ==  null)
                        {
                            $product_count = $cart->get_count_sold_product($result['productID']);
                        }
                        else
                        {
                            $product_count = $cart->get_count_sold_product_with_period($result['productID'], $from_date, $to_date);
                        }
                        $result_count = $product_count->fetch_assoc();
                        $count= $result_count['cnt'];
                        echo $count;
                    ?>  
            <td>
                <?php
                    $total_price += $count*$price;
                    echo number_format($count*$price, 0, ',', '.');
                ?>
                <a>₫</a>
            </td>

        </tr>
        <?php
                }
            }
        ?>
    </table>
    <h1 style ="text-align: right">TOTAL REVENUE = 
        <?php
            echo number_format($total_price, 0, ',', '.')
        ?><a>₫</a>
    </h1>
</body>
</html>