<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="public/css/card.css" />   
    <link rel="stylesheet" href="public/css/search.css" />  
</head>
<body> 
<div style='min-height:100%'>
    <?php 
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Category.php';
        require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php';
        $product = new Product; 
        $cat = new Category;
        $brand = new Brand;
    ?>
    
    <br />

    <div class="search-container">
        <form action="search" method="post">
        <input type="text" name="keyword" placeholder="Tất cả sản phẩm..."/>
        <input type="submit" name="search_product" value="Tìm kiếm"/>
        <div class="choice">
            <select id="select" name="category">
                <option value="%">Tất cả danh mục</option>
                <?php
                    $catlist = $cat->show_category();
                    if ($catlist) {
                        while ($result = $catlist->fetch_assoc()) {
                ?>
                <option value="<?php echo $result['catID'] ?>"><?php echo $result['catName'] ?></option>
                <?php
                        }
                    }
                ?>
            </select>

            <select id="select" name="brand">
            <option value="%">Tất cả thương hiệu</option>
            <?php
                $brandlist = $brand->show_brand();
                if ($brandlist) {
                    while ($result = $brandlist->fetch_assoc()) {
            ?>
            <option value="<?php echo $result['brandID'] ?>"><?php echo $result['brandName'] ?></option>
            <?php
                    }
                }
            ?>
        </select>
        </div>
        <br>
        Khoảng giá: từ
        <input type="number" name="from_price" value="0" min="0"/>₫
        đến 
        <input type="number" name="to_price" value="200000000" min="0"/>₫
        </form>
    </div>

    <?php
        $catlist = $cat->show_category();
        if ($catlist) {
            while ($result = $catlist->fetch_assoc()) {
    ?>
    <h1 style="padding-top: 50px; padding-left: 10px"><?php echo $result['catName'] ?></h1>
    <form style="padding-left: 10px" action="search" method="post">
    <input type="hidden" name="keyword" placeholder="Tìm kiếm sản phẩm..." value=""/>
    <input type="submit" name="search_product" value="Xem tất cả &raquo"/>
    <input type="hidden" name="category" placeholder="Tìm kiếm sản phẩm..." value="<?php echo $result['catID'] ?>"/>
    <input type="hidden" name="brand" placeholder="Tìm kiếm sản phẩm..." value="%"/>
    <input type="hidden" name="from_price" value="0"/>
    <input type="hidden" name="to_price" value="200000000"/>
    </form>
    <hr />
    <br />
    <div class="product-container">
    <?php
        $laptopProducts = $product->get_products_by_category($result['catID']);
        if ($laptopProducts) {
        $numCards = 0;
        while (($result = $laptopProducts->fetch_assoc()) && ($numCards < 3)) {
            $numCards++;
    ?>
    <div class="card">
        <div class="img">
        <a href='details&productid=<?php echo $result['productID']; ?>'>
        <img
            src="public/uploads/<?php echo $result['product_image']; ?>"
        />
        </a>
        </div>
        <div class="text">
        <?php echo $result['productName']; ?>
        </div>
        <div class="price">
        <?php echo number_format($result['price'], 0, ',', '.'); ?>₫
        </div>
    </div>
    <?php
        }
        }
    ?>
    </div>   
    <?php
            }
        }
    ?>
</div>
</body>
</html>