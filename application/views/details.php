<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>
    <link rel="stylesheet" href="public/css/details.css">
    <link rel="stylesheet" href="public/css/header.css">
</head>

<body>     
    <?php
        require_once ROOT . DS . 'application' . DS . 'views' . DS . 'header.php';   
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
        $id = $_GET['productid'];  

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

            <form action="" method='POST'>
                <input type="hidden" name="productid" value='<?php echo $result_details['productID'] ?>'/>   
            </form>

            <form action="" method='POST'>
                <input type="hidden" name="productid" value='<?php echo $result_details['productID'] ?>'/>   

         
            </form>
            </div>
    </main>
    <?php
            }
        }
    ?>     
</body>
</html>
