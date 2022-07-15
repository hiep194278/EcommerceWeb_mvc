<?php

class Bridge {
    private $url;
    private $dispatch;
    private $isAdmin = false;
    private $isLoginAdmin = false;

    function __construct($url) {
        $this->url = $url;
        self::process_URL();
    }

    //Handle URL
    function process_URL() {
        //Home
        if(strcmp($this->url, "/") == 0){
            require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'HomeController.php';
            $this->dispatch = new HomeController();
            return;
        }

        $urlArray = explode("/", $this->url);
        $controller = $urlArray[0]; array_shift($urlArray);

        if (strcmp($controller, "loginAdmin") == 0) {
            $this->isLoginAdmin = true;
        }

        //Admin controller
        if ( strcmp($controller, "admin") == 0 || 
             strcmp($controller, "loginAdmin") == 0 || 
             strcmp($controller, "homeAdmin") == 0 || 
             strcmp($controller, "addProductAdmin") == 0 || 
             strcmp($controller, "addBrandAdmin") == 0 || 
             strcmp($controller, "addCategoryAdmin") == 0 || 
             strcmp($controller, "brandListAdmin") == 0 || 
             strcmp($controller, "categoryListAdmin") == 0 || 
             strcmp($controller, "productListAdmin") == 0 || 
             strcmp($controller, "customerListAdmin") == 0 || 
             strcmp($controller, "customerInformationAdmin") == 0 ||
             strcmp($controller, "editProductAdmin") == 0 || 
             strcmp($controller, "editBrandAdmin") == 0 || 
             strcmp($controller, "editCategoryAdmin") == 0 || 
             strcmp($controller, "orderAdmin") == 0 || 
             strcmp($controller, "orderDetailsAdmin") == 0 || 
             strcmp($controller, "revenueAdmin") == 0 || 
             strcmp($controller, "productDetailsAdmin") == 0 )
        {
            $this->isAdmin = true;
        }

        $controller = ucwords($controller);
        $controller .= "Controller"; 

        if ($this->isAdmin == false)
            require_once ROOT . DS . 'application' . DS . 'controllers' . DS . $controller . '.php';
        else 
            require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'admin' . DS . $controller . '.php';

        $this->dispatch = new $controller();
    }

    function show() {
        //Show header
        if ($this->isAdmin == false) {
            $this->dispatch->header();
        } else {
            if ($this->isLoginAdmin == false)
                $this->dispatch->adminHeader();
        }

        //Show body
        $this->dispatch->render();

        //Show footer
        if ($this->isAdmin == false) {
            $this->dispatch->footer();
        }
    }
}