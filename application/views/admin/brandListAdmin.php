<?php
    require_once ROOT . DS . 'application' . DS . 'models' . DS . 'Brand.php';

    $brand = new Brand();
    if (isset($_GET['delID'])) {
        $id = $_GET['delID'];
        $delBrand = $brand->delete_brand($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thương hiệu</title>
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
          <input type="text" name="keyword" placeholder="Tất cả thương hiệu..." value="<?php echo $keyword; ?>"/>
          <input type="submit" name="search_product" value="Tìm kiếm"/>
        </form>
    </div>

    <br><br>
    <?php
        if (isset($delBrand)) {
            echo $delBrand;
        }
    ?>
    <table>
        <tr>
            <th>Số thứ tự</th>
            <th>Tên thương hiệu</th>
            <th>Tùy chọn</th>
        </tr>
        <?php
            $show_brand = $brand->show_brand();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $keyword = $_POST['keyword'];
                $show_brand = $brand->search_brand_admin($_POST);
            } 

            if ($show_brand) {
                $i = 0;
                while ($result = $show_brand->fetch_assoc()) {
                    $i++;
        ?> 
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $result['brandName'] ?></td>
            <td><a href="editBrandAdmin&brandid=<?php echo $result['brandID'] ?>">Chỉnh sửa</a> || 
                <a onClick="return confirm('Bạn có muốn xóa thương hiệu này?')" href="brandListAdmin&delID=<?php echo $result['brandID']?>">Xóa</a></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</body>
</html>