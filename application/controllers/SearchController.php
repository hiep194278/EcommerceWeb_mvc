<?php
require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'Controller.php';
require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'BaseController.php';
require_once ROOT . DS . 'library' . DS . 'Database.php';

class SearchController extends BaseController implements Controller{
    public function render() {
        include ROOT . DS . 'application' . DS . 'views' . DS . 'search.php';
    }
}