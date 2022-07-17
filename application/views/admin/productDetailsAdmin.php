<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
    
    if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
        echo "<script>windows.location = 'revenueAdmin'</script>";
    } else {
        $id = $_GET['productid'];
    }
    
    $customerID = Session::get('customer_id');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="public/css/details.css" />
</head>

<body>
    <?php
        $product = new Product();
        $getDetails = $product->get_details($id);
        if ($getDetails) {
            while ($result_details = $getDetails->fetch_assoc()) {
    ?>  
    <h1><br><?php echo $result_details['productName']; ?></h1>
    <main class="container">
        <div class="left-column">
            <img
                src="public/uploads/<?php echo $result_details['product_image']; ?>"
            />
        </div>

        <div class="right-column">
            <div class="product-description">
            <span><?php echo $result_details['catName']; ?></span>
            <h2><?php echo $result_details['brandName']; ?></h2>
            <textarea readonly style="height:300px; width:450px"><?php echo $result_details['product_desc']; ?></textarea>
        </div>

        <div class="product-price">
            Giá tiền: 
            <span><?php echo number_format($result_details['price'], 0, ',', '.');?>₫</span>
            <br><br>

        </div>
    </main>
    <?php
            }
        }
    ?>
</body>
</html>