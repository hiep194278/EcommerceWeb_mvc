<?php
    include_once ROOT . DS . 'application' . DS . 'views' . DS . 'headerAdmin.php';
    include_once ROOT . DS . 'application' . DS . 'models' . DS . 'Category.php';
?>
<?php
    $cat = new Category();
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php'</script>";
    } else {
        $id = $_GET['catid'];
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $updateCat = $cat->update_category($catName, $id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục sản phẩm</title>
</head>

<body> 

    <?php
        $get_cate_name = $cat->getcatbyID($id);
        if ($get_cate_name) {
            while ($result = $get_cate_name->fetch_assoc()) {
    ?>
    <br><br>
    <form style="border: 3px solid #f1f1f1;width: 30%;margin-left: 35%;" action="" method="POST">
        <div class="container">
            <label style="font-size:20px"><b>Sửa danh mục sản phẩm</b></label>
            <br>
            <?php
                if (isset($updateCat)) {
                    echo $updateCat;
                }
            ?>
            <input style="width: 100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;" type="text" value="<?php echo $result['catName'] ?>" name="catName" required/> 
            <button style="background-color: #04aa6d;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;font-size: 20px;font-weight: bold;" type="submit">Cập nhật</button>
        </div>
    </form>
    <?php
            }
        }
    ?>
</body>
</html>