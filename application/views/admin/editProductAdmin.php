<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php'; 
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Category.php';
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Product.php';
?>
<?php
    $product = new Product();
    if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
        echo "<script>windows.location = 'productListAdmin'</script>";
    } else {
        $id = $_GET['productid'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updateProduct = $product->update_product($_POST, $_FILES, $id);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
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

    <?php
        $get_product_by_id = $product->getproductbyID($id); 
        if ($get_product_by_id) {
            while ($result_product = $get_product_by_id->fetch_assoc()) {
         
    ?>

    <form action="" method='POST' enctype="multipart/form-data" style='width:30%;margin-left: 35%;'>
        <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
        ?>

        <br>

        <label>Tên sản phẩm</label>
        <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>">

        <label>Danh mục</label>
        <select id="select" name="category">
            <option value="">Chọn danh mục</option>
            <?php
                $cat = new Category();
                $catlist = $cat->show_category();
                if ($catlist) {
                    while ($result = $catlist->fetch_assoc()) {
            ?>
            <option <?php if ($result['catID'] == $result_product['catID']) {echo 'selected';} ?> value="<?php echo $result['catID'] ?>"><?php echo $result['catName'] ?></option>
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
            <option <?php if ($result['brandID'] == $result_product['brandID']) {echo 'selected';} ?> value="<?php echo $result['brandID'] ?>"><?php echo $result['brandName'] ?></option>
            <?php
                    }
                }
            ?>
        </select>

        <label>Giá tiền</label>
        <input type='text' name='price' placeholder='Nhập giá của sản phẩm..' value="<?php echo $result_product['price'] ?>"></input>

        <label>Sản phẩm nổi bật</label>
        <select id="select" name="featured">
            <?php
                if ($result_product['featured'] == 1) {
            ?>
            <option selected value='1'>Có</option>
            <option value='0'>Không</option>
            <?php
                } else {
            ?>
            <option value='1'>Có</option>
            <option selected value='0'>Không</option>
            <?php
                }
            ?>
        </select>

        <label>Ảnh sản phẩm</label>
        <img src="uploads/<?php echo $result_product['product_image'] ?>" height="500" width="500">
        <input type='file' name='image' />
        <input type='hidden' name='old_image' value='<?php echo $result_product['product_image'] ?>'/>

        <br>

        <label>Mô tả</label>  
        <textarea name="product_desc" placeholder="Mô tả sản phẩm.." style="height:200px"><?php echo $result_product['product_desc'];?></textarea>
       
        <input type="submit" value="Sửa sản phẩm">
    </form>

    <?php
            }
        }
    ?>

</body>
</html>