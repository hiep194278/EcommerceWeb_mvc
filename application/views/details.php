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
<div style='min-height:100%'>
    <?php
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Cart.php';
        $product = new Product;
        $cart = new Cart;

        if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
            echo "<script>windows.location = 'home'</script>";
        } else {
            $id = $_GET['productid'];
        }
    
        $customerID = Session::get('customer_id');
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
            $productID = $_POST['productid'];
            $insertWishlist = $product->insert_wishlist($productID, $customerID);
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buybutton'])) {
            $quantity = $_POST['buynumber'];
            $addCart = $cart->add_to_cart($quantity, $id);
        }  

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

            <form action="" method="POST">
                <?php
                    $loginCheck = Session::get('customer_login');
                    if ($loginCheck) { 
                        echo 'Số lượng:';
                        echo '<input type="number" name="buynumber" value="1" min="1"/>';
                        echo '<input type="submit" name="buybutton" value="Thêm vào giỏ hàng"/>';
                    }
                ?>
                
                
                
            </form>
 
            <form action="" method='POST'>
                <input type="hidden" name="productid" value='<?php echo $result_details['productID'] ?>'/>   
                <?php
                    $loginCheck = Session::get('customer_login');
                    if ($loginCheck) { 
                        echo '<input type="submit" name="wishlist" value="Thêm vào Wishlist"/>';
                    }
                ?>
         
            </form>

            <?php
                if (isset($addCart)) {
                    echo $addCart;
                }

                if (isset($insertWishlist)) {
                    echo $insertWishlist;
                }
            ?>

            </div>
    </main>
    <?php
            }
        }
    ?>     
    </div>
</body>
</html>
