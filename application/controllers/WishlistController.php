<?php
require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'Controller.php';
require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'BaseController.php';

class WishlistController extends BaseController implements Controller{
    public function render() {
        require_once ROOT . DS . 'application' . DS . 'views' . DS . 'wishlist.php'; 
    }
}