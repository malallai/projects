<?php

require 'Core/Autoloader.php';
Autoloader::register();

use Pages\GeneralPage;
use Core\Router;

$url = $_GET['url'];

$router = new Router();
$router->addRoute("", "Pages\GeneralPage@index");

$router->addRoute("user", "Pages\UserPage@index");
$router->addRoute("profile", "Pages\ProfilePage@index");

$router->addRoute("user/login", "Pages\UserPage@login");
$router->addRoute("user/register", "Pages\UserPage@register");
$router->addRoute("user/resetpw", "Pages\UserPage@resetpwd");
$router->addRoute("user/confirm", "Pages\UserPage@confirm");
$router->addRoute("user/logout", "Pages\UserPage@logout");


$router->addRoute("dev", "Pages\GeneralPage@dev");
$router->route($url);