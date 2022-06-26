<?php
$project_path = 'EcommerceWeb_mvc';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . $project_path);

require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'RouteController.php';
$url = isset($_GET["url"]) ? $_GET["url"] : "/";

// echo  $_SERVER['REQUEST_URI'];

$route = new RouteController($url);
$route->show();
