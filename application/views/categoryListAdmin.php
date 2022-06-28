<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Category.php';
    $cat = new Category();
    
    if (isset($_GET['delID'])) {
        $id = $_GET['delID'];
        $delCat = $cat->delete_category($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục</title>
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
          ?>
          <input type="text" name="keyword" placeholder="Tất cả danh mục..." value="<?php echo $keyword; ?>"/>
          <input type="submit" name="search_product" value="Tìm kiếm"/>
        </form>
    </div>

    <br><br>
    <?php
        if (isset($delCat)) {
            echo $delCat;
        }
    ?>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Tên danh mục</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $show_cate = $cat->show_category();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $keyword = $_POST['keyword'];
                $show_cate = $cat->search_category_admin($_POST);
            } 

            if ($show_cate) {
                $i = 0;
                while ($result = $show_cate->fetch_assoc()) {
                    $i++;
        ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $result['catName'] ?></td>
            <td><a href="editCategoryAdmin&catid=<?php echo $result['catID'] ?>">Chỉnh sửa</a> || 
                <a onClick="return confirm('Bạn có muốn xóa danh mục này?')" href="categoryListAdmin&delID=<?php echo $result['catID']?>">Xóa</a></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</body>
</html>