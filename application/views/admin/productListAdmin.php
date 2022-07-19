<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php'; 
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Category.php';
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'helpers' . DS . 'Format.php';
?>

<?php
    $format = new Format();
    $product = new Product();
    $cat = new Category();
    $brand = new Brand();
    if (isset($_GET['delID'])) {
        $id = $_GET['delID'];
        $oldImage = $_GET['oldimage'];
        $delProduct = $product->delete_product($id, $oldImage);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
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

    <br><br>
    <?php
        if (isset($delProduct)) {
            echo $delProduct;
        }
    ?>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Giá tiền</th>
            <th>Ảnh sản phẩm</th>
            <th>Nổi bật</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $show_product = $product->show_product();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $keyword = $_POST['keyword'];
                $show_product = $product->search_product_admin($_POST);
            } 

            if ($show_product) {
                $i = 0;
                while ($result = $show_product->fetch_assoc()) {
                    $i++;
        ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $format->textShorten($result['productName'], 50); ?></td>
            <td><?php echo $result['catName'] ?></td>
            <td><?php echo $result['brandName'] ?></td>
            <td><?php echo number_format($result['price'], 0, ',', '.') ?>₫</td>
            <td><img src="public/uploads/<?php echo $result['product_image'] ?>" height="120" width="140"></td>
            <td><?php 
                if ($result['featured'] == 1)
                    echo "Có";
                else
                    echo "Không";
            ?></td>
            <td><a href="editProductAdmin&productid=<?php echo $result['productID'] ?>">Chỉnh sửa</a> || 
                <a onClick="return confirm('Bạn có muốn xóa sản phẩm này?')" href="productListAdmin&delID=<?php echo $result['productID']?>&oldimage=<?php echo $result['product_image'] ?>">Xóa</a></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</body>
</html>