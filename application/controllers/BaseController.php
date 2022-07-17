<?php
class BaseController {
    public function header() {
        include ROOT . DS . 'application' . DS . 'views' . DS . 'header.php'; 
    }

    public function adminHeader() {
        include ROOT . DS . 'application' . DS . 'views' . DS . 'admin' . DS . 'headerAdmin.php'; 
    }

    public function footer() {
        include ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php'; 
    }
}