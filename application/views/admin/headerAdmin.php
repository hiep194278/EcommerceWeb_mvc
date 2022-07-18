<?php
    require_once ROOT . DS . 'library' . DS . 'Session.php';
    Session::checkSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public/css/headerAdmin.css">
</head>

<body>
    <div class="topnav">
        <div class="subnav">
            <button class="subnavbtn">SẢN PHẨM<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="addProductAdmin">Thêm sản phẩm</a>
                <a href="productListAdmin">Danh sách sản phẩm</a>
            </div>
        </div> 
        <div class="subnav">
            <button class="subnavbtn">DANH MỤC<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="addCategoryAdmin">Thêm danh mục</a>
                <a href="categoryListAdmin">Danh sách danh mục</a>
            </div>
        </div> 
        <div class="subnav">
            <button class="subnavbtn">THƯƠNG HIỆU<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="addBrandAdmin">Thêm thương hiệu</a>
                <a href="brandListAdmin">Danh sách thương hiệu</a>
            </div>
        </div> 
        <a href="customerListAdmin">KHÁCH HÀNG</a>
        <a href="orderAdmin">ĐƠN HÀNG</a>
        <a href="revenueAdmin">DOANH THU</a>   
        <div class="user-menu">
            <a href="">
            ADMIN <?php echo Session::get('adminName') ?>
            </a>
            
            <?php
                if (isset($_GET['action']) && ($_GET['action']=='logout')) {
                    Session::destroyAdmin();
                }
            ?>
            <a href= "homeAdmin&action=logout">
            ĐĂNG XUẤT 
            </a>
        </div>
    </div>
</body>
</html>