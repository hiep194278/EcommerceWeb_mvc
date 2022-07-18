<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
    $product = new Product;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>home</title>
    <link rel="stylesheet" href="public/css/card.css" />    
  </head>

  <body> 
  <div style='min-height:100%'>
    <?php
      require_once ROOT . DS . 'application' . DS . 'views' . DS . 'slider.php';
    ?>
    <br />

    <h1 style="padding-top: 100px; padding-left: 10px">Sản phẩm nổi bật</h1>
    <hr />
    <br />
    <div class="product-container">
      <?php
        $featuredProducts = $product->get_featured_products();
        if ($featuredProducts) {
          $numCards = 0;
          while (($result = $featuredProducts->fetch_assoc()) && ($numCards < 3)) {
            $numCards++;
      ?>
      <div class="card">
        <div class="img">
          <a href="details&productid=<?php echo $result['productID'] ?>">        
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
    
    <h1 style="padding-top: 100px; padding-left: 10px">Sản phẩm mới</h1>
    <hr />
    <br />
    <div class="product-container">
      <?php
        $newProducts = $product->get_new_products();
        if ($newProducts) {
          $numCards = 0;
          while (($result = $newProducts->fetch_assoc()) && ($numCards < 3)) {
            $numCards++;
      ?>
      <div class="card">
        <div class="img">
        <a href="details&productid=<?php echo $result['productID'] ?>">
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
    </div>
  </body>
</html>