<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php'; 
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Category.php';
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
?>
<?php
    $product = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $insertProduct = $product->insert_product($_POST, $_FILES);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <style>
        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            float: right;
        }
    </style>
</head>
<body>

    <form action="addProductAdmin" method='POST' enctype="multipart/form-data" style='width:30%;margin-left: 35%;'>
        <?php
            if (isset($insertProduct)) {
                echo $insertProduct;
            }
        ?>

        <br>

        <label>Tên sản phẩm</label>
        <input type="text" name="productName" placeholder="Nhập tên sản phẩm..">

        <label>Danh mục</label>
        <select id="select" name="category">
            <option value="">Chọn danh mục</option>
            <?php
                $cat = new Category();
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

        <label>Thương hiệu</label>
        <select id="select" name="brand">
            <option value="">Chọn thương hiệu</option>
            <?php
                $brand = new Brand();
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

        <label>Giá tiền</label>
        <input type='text' name='price' placeholder='Nhập giá của sản phẩm..'></input>

        <label>Sản phẩm nổi bật</label>
        <select id="select" name="featured">
            <option value='1'>Có</option>
            <option value='0'>Không</option>
        </select>

        <label>Ảnh sản phẩm</label>
        <input type='file' name='image' />

        <br>

        <label>Mô tả</label>  
        <textarea name="product_desc" placeholder="Mô tả sản phẩm.." style="height:200px"></textarea>
       
        <input type="submit" value="Thêm sản phẩm">
    </form>

</body>
</html>