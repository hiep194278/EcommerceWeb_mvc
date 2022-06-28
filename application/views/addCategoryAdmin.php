<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Category.php';
?>
<?php
    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $insertCat = $cat->insert_category($catName);
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục sản phẩm</title>
</head>

<body>
    
    <br><br>
    <form style="border: 3px solid #f1f1f1;width: 30%;margin-left: 35%;" action="addCategoryAdmin" method="POST">
        <div class="container">
            <label style="font-size:20px"><b>Nhập danh mục sản phẩm</b></label>
            <br>
            <?php
            if (isset($insertCat)) {
                echo $insertCat;
            }
            ?>
            <input style="width: 100%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid #ccc;box-sizing: border-box;" type="text" placeholder="Nhập tên danh mục..." name="catName" required/> 
            <button style="background-color: #04aa6d;color: white;padding: 14px 20px;margin: 8px 0;border: none;cursor: pointer;width: 100%;font-size: 20px;font-weight: bold;" type="submit">Thêm danh mục mới</button>
        </div>
    </form>
</body>
</html>