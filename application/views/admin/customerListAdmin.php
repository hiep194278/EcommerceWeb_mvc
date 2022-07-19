<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Customer.php';
    Session::checkSession();

    $customer = new Customer();
    if (isset($_GET['delID'])) {
        $id = $_GET['delID'];
        $delCustomer = $customer->delete_customer($id);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách khách hàng</title>
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
    <div class="search-container">
        <form action="" method="post">
          <?php
            if (isset($_POST['keywordID'])) {
              $customerID = $_POST['keywordID'];
            } else {
              $customerID = "";
            }

            if (isset($_POST['keywordName'])) {
              $customerName = $_POST['keywordName'];
            } else {
              $customerName = "";
            }
            
            if (isset($_POST['keywordAddress'])) {
              $customerAddress = $_POST['keywordAddress'];
            } else {
              $customerAddress = "";
            }

            if (isset($_POST['keywordPhone'])) {
              $customerPhone = $_POST['keywordPhone'];
            } else {
              $customerPhone = "";
            }

            if (isset($_POST['keywordEmail'])) {
              $customerEmail = $_POST['keywordEmail'];
            } else {
              $customerEmail = "";
            }
          ?>
          <input type="text" name="keywordID" placeholder="ID" value="<?php echo $customerID; ?>"/>
          <input type="text" name="keywordName" placeholder="Tên" value="<?php echo $customerName; ?>"/>
          <input type="text" name="keywordAddress" placeholder="Địa chỉ" value="<?php echo $customerAddress; ?>"/>
          <input type="text" name="keywordPhone" placeholder="Số điện thoại" value="<?php echo $customerPhone; ?>"/>
          <input type="text" name="keywordEmail" placeholder="Email" value="<?php echo $customerEmail; ?>"/>
          <br>
          <input type="submit" name="search_product" value="Tìm kiếm"/>
          
        </form>
    </div>

    <br><br>
    <?php
        if (isset($delCustomer)) {
            echo $delCustomer;
        }
    ?>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $show_customer = $customer->show_all_customers();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $show_customer = $customer->search_customer_admin($_POST);
            } 

            if ($show_customer) {
                $i = 0;
                while ($result = $show_customer->fetch_assoc()) {
                    $i++;
        ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $result['customerID']; ?></td>
            <td><?php echo $result['customerName'] ?></td>
            <td><?php echo $result['customerAddress'] ?></td>
            <td><?php echo $result['phone'] ?></td>
            <td><?php echo $result['email'] ?></td>
            <td> 
                <a href="customerInformationAdmin&customerid=<?php echo $result['customerID'] ?>">Hiện thông tin</a> || 
                <a onClick="return confirm('Bạn có muốn xóa khách hàng này?')" href="customerListAdmin&delID=<?php echo $result['customerID']?>">Xóa</a>
            </td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</body>
</html>