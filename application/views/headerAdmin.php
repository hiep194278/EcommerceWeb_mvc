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
        <a href="homeAdmin">TRANG CHỦ</a>
        <div class="subnav">
            <button class="subnavbtn">SẢN PHẨM<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="addproduct">Thêm sản phẩm</a>
                <a href="productlist.php">Danh sách sản phẩm</a>
            </div>
        </div> 
        <div class="subnav">
            <button class="subnavbtn">DANH MỤC<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="addcat.php">Thêm danh mục</a>
                <a href="catlist.php">Danh sách danh mục</a>
            </div>
        </div> 
        <div class="subnav">
            <button class="subnavbtn">THƯƠNG HIỆU<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="addbrand.php">Thêm thương hiệu</a>
                <a href="brandlist.php">Danh sách thương hiệu</a>
            </div>
        </div> 
        <div class="subnav">
            <button class="subnavbtn">ĐƠN HÀNG<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="adminOrder">Danh sách đơn hàng</a>
            </div>
        </div> 
        <div class="subnav">
            <button class="subnavbtn">THỐNG KÊ DOANH THU<i class="fa fa-caret-down"></i></button>
            <div class="subnav-content">
                <a href="statisticrevenue.php">DOANH THU</a>
            </div>
        </div>         
        <div class="user-menu">
            <a href="account.html">
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