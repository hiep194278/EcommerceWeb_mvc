<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Customer.php';
    Session::checkSession();

    $customer = new Customer();
    if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
        echo "<script>window.location = 'homeAdmin'</script>";
    } else {
        $id = $_GET['customerid'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục sản phẩm</title>
    <link rel="stylesheet" href="public/css/customer.css" />
</head>

<body>

    <?php
        $getCustomer = $customer->show_customer($id);
        if ($getCustomer) {
            while ($result = $getCustomer->fetch_assoc()) {
    ?>
    <br><br>
    <h2 style="text-align: center">HỒ SƠ KHÁCH HÀNG</h2>
    <form action="" method="post" class="log-form">
        <div class="container">
            <label><b>ID </b></label>
            <input type="text" placeholder="Nhập tên" name="name" value="<?php echo $result['customerID']; ?>" readonly>

            <label><b>Tên</b></label>
            <input type="text" placeholder="Nhập tên" name="name" value="<?php echo $result['customerName']; ?>" readonly>

            <label><b>Địa chỉ</b></label>
            <input type="text" placeholder="Địa chỉ của bạn" name="address" value="<?php echo $result['customerAddress']; ?>" readonly>
            
            <label><b>Số điện thoại</b></label>
            <input type="text" placeholder="Điện thoại" name="phone" value="<?php echo $result['phone']; ?>" readonly>

            <label><b>Email</b></label>
            <input type="text" placeholder="Email" name="email" value="<?php echo $result['email']; ?>" readonly>

        </div>
    </form>
    <?php
            }
        }
    ?>
</body>
</html>