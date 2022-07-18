<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="public/css/cart.css" />
</head>
<body>
<div style='min-height:100%'>
    <?php 
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
        $product = new Product;  

        if (isset($_GET['productid'])) {
            $productID = $_GET['productid'];
            $customerID = Session::get('customer_id');
            $deleteWishlistItem = $product->del_wishlist_item($productID, $customerID);
        }
    ?>
    
    <h1 style='text-align: center;'>DANH SÁCH YÊU THÍCH</h1>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $customerID = Session::get('customer_id');
            $getWishlist = $product->get_wishlist($customerID);
            
            $id = 0;
            if ($getWishlist) {    
                while ($result = $getWishlist->fetch_assoc()) {
                    $id = $id + 1; 
                    
        ?> 
        <tr>
            <td><?php echo $id ?></td>
            <td><img src="public/uploads/<?php echo $result['productImage'] ?>" height="120" width="140"></td>
            <td><?php echo $result['productName'] ?></td>
            <td><?php echo number_format($result['price'], 0, ',', '.'); ?>₫</td>
            <td>
                <a href="wishlist&productid=<?php echo $result['productID']?>">Xóa</a> ||
                <a href="details&productid=<?php echo $result['productID']?>">Mua ngay</a>
            </td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
    </div>
</body>
</html>