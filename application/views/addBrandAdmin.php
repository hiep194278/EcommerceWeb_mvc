<?php
    include_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php'; 
?>
<?php
    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $insertBrand = $brand->insert_brand($brandName);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm thương hiệu sản phẩm</title>
</head>

<body>

    <br><br>
    <form style="border: 3px solid #f1f1f1;width: 30%;margin-left: 35%;" action="addBrandAdmin" method="POST">
        <div class="container">
            <label style="font-size:20px"><b>Nhập thương hiệu sản phẩm</b></label>
            <br>
            <?php
            if (isset($insertBrand)) {
                echo $insertBrand;
            }
            ?>
            <input style="width: 100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;" type="text" placeholder="Nhập tên thương hiệu..." name="brandName" required/> 
            <button style="background-color: #04aa6d;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;font-size: 20px;font-weight: bold;" type="submit">Thêm thương hiệu mới</button>
        </div>
    </form>
</body>
</html>