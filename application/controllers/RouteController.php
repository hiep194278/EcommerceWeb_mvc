<?php

class RouteController {
    private $url;
    private $dispatch;
    private $isAdmin = false;

    function __construct($url) {
        $this->url = $url;

        self::process_URL();
    }

    function process_URL() {
        if(strcmp($this->url, "/") == 0){
            require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'HomeController.php';
            $this->dispatch = new HomeController();
            return;
        }

        $urlArray = explode("/", $this->url);
        $controller = $urlArray[0]; array_shift($urlArray);


        // check if admin -> no footer
        if(strcmp($controller, "admin") == 0
            || strcmp($controller, "loginAdmin") == 0
            || strcmp($controller, "homeAdmin") == 0
            || strcmp($controller,"addProductAdmin") == 0
            || strcmp($controller,"addBrandAdmin") == 0
            || strcmp($controller,"addCategoryAdmin") == 0
            || strcmp($controller,"brandListAdmin") == 0
            || strcmp($controller,"categoryListtAdmin") == 0
            || strcmp($controller,"productListAdmin") == 0
            || strcmp($controller,"customerInformationAdmin") == 0
            || strcmp($controller,"editProductAdmin") == 0
            || strcmp($controller,"editBrandAdmin") == 0
            || strcmp($controller,"editCategoryAdmin") == 0
            || strcmp($controller,"orderAdmin") == 0
            || strcmp($controller,"orderDetailsAdmin") == 0
            || strcmp($controller,"revenueAdmin") == 0
            || strcmp($controller,"productDetailsAdmin") == 0){
            $this->isAdmin = true;
        }

        // if link is account-management => controller of link is AccountManagementController
        $controller = str_replace('-', ' ', $controller);
        $controller = ucwords($controller);
        $controller = str_replace(' ', '', $controller);
        $controller .= "Controller"; // example : AboutController, ContactController,...

        // include controller
        require_once ROOT . DS . 'application' . DS . 'controllers' . DS . $controller . '.php';
        $this->dispatch = new $controller();

    }

    function show() {
        $this->dispatch->render();
        if ($this->isAdmin == false) {
            $this->dispatch->footer();
        }
    }
}