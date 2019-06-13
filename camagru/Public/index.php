<?php

chdir('..');

require 'Core/Autoloader.php';
Autoloader::register();

use Pages\GeneralPage;
use Core\Router;

$url = $_GET['url'];

$router = new Router();
$router->addRoute("", "Pages\GeneralPage@index");
$router->addRoute("user", "Pages\UserPage@index");
$router->addRoute("user/login", "Pages\UserPage@login");
$router->route($url);