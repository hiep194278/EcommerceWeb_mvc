<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="public/css/search.css" />  
    <link rel="stylesheet" href="public/css/card.css" /> 
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
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $keyword = $_POST['keyword'];
            $searchProduct = $product->search_product($_POST);
        } 
    ?>
   
    <div class="search-container">
        <form action="search" method="post">
          <?php
            if (isset($_POST['keyword'])) {
              $keyword = $_POST['keyword'];
            } else {
              $keyword = "";
            }

            if (isset($_POST['category'])) {
              $category = $_POST['category'];
            } 

            
            if (isset($_POST['brand'])) {
              $selectedBrand = $_POST['brand'];
            } 
          ?>
          <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
          <input type="text" name="keyword" placeholder="Tất cả sản phẩm..." value="<?php echo $keyword; ?>"/>
          <input type="submit" name="search_product" value="Tìm kiếm"/>
          <div class="choice">
            <select id="select" name="category">
                <option value="%">Tất cả danh mục</option>
                <?php   
                    $catlist = $cat->show_category();
                    if ($catlist) {
                        while ($result = $catlist->fetch_assoc()) {
                          if ($category == $result['catID']) {
                ?>
                            <option selected value="<?php echo $result['catID'] ?>"><?php echo $result['catName'] ?></option>
                <?php
                          } else { 
                ?>
                            <option value="<?php echo $result['catID'] ?>"><?php echo $result['catName'] ?></option>
                <?php
                          }
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
                      if ($selectedBrand == $result['brandID']) {
              ?>
                        <option selected value="<?php echo $result['brandID'] ?>"><?php echo $result['brandName'] ?></option>
              <?php
                      } else {
              ?>
                         <option value="<?php echo $result['brandID'] ?>"><?php echo $result['brandName'] ?></option>         
              <?php
                      }
                    }
                  }
              ?>
            </select>
          </div>
          <br>
          <?php
            if (isset($_POST['from_price'])) {
              $fromPrice = $_POST['from_price'];
            } else {
              $fromPrice = 0;
            }

            if (isset($_POST['to_price'])) {
              $toPrice = $_POST['to_price'];
            } else {
              $toPrice = 200000000;
            }
          ?>
          Khoảng giá: từ
          <input type="number" name="from_price" id="currency" value="<?php echo $fromPrice ?>" min="0"/>₫
          đến 
          <input type="number" name="to_price" value="<?php echo $toPrice ?>" min="0"/>₫
        </form>
    </div>
 
    <h1 style="padding-top: 100px; padding-left: 10px">Các sản phẩm tìm được</h1>
    <hr />
    <br />
    <div class="product-container">
      <?php
        if ($searchProduct) {
          while (($result = $searchProduct->fetch_assoc())) {
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
          <?php echo number_format($result['price'], 0, ',', '.');; ?>₫
        </div>
      </div>
      <?php
          }
        }
      ?>
    </div>   
    </div>
</body>
</html>