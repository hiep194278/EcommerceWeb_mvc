<?php

$project_path = 'EcommerceWeb_mvc';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . $project_path);

require_once ROOT . DS . 'application' . DS . 'controllers' . DS . 'Bridge.php';

$url = isset($_GET["url"]) ? $_GET["url"] : "/";

$route = new Bridge($url);
$route->show();
