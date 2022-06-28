<?php
    include_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php';
?>
<?php
    $brand = new Brand();
    if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        echo "<script>window.location = 'brandListAdmin'</script>";
    } else {
        $id = $_GET['brandid'];
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->update_brand($brandName, $id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thương hiệu sản phẩm</title>
</head>

<body>

    <?php
        $get_brand_name = $brand->getbrandbyID($id);
        if ($get_brand_name) {
            while ($result = $get_brand_name->fetch_assoc()) {
    ?>
    <br><br>
    <form style="border: 3px solid #f1f1f1;width: 30%;margin-left: 35%;" action="" method="POST">
        <div class="container">
            <label style="font-size:20px"><b>Sửa thương hiệu sản phẩm</b></label>
            <br>
            <?php
                if (isset($updateBrand)) {
                    echo $updateBrand;
                }
            ?>
            <input style="width: 100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;" type="text" value="<?php echo $result['brandName'] ?>" name="brandName" required/> 
            <button style="background-color: #04aa6d;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;font-size: 20px;font-weight: bold;" type="submit">Cập nhật</button>
        </div>
    </form>
    <?php
            }
        }
    ?>
</body>
</html>