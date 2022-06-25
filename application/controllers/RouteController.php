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
            || strcmp($controller, "loginAdmin") == 0){
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