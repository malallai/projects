<?php

require 'Core/Autoloader.php';
Autoloader::register();

use Pages\GeneralPage;
use Core\Router;

$url = $_GET['url'];

$router = new Router();
$router->addRoute("", "Pages\GeneralPage@index");
$router->addRoute("index", "Pages\GeneralPage@index");

$router->addRoute("user", "Pages\UserPage@index");

$router->addRoute("user/login", "Pages\UserPage@login");
$router->addRoute("user/register", "Pages\UserPage@register");
$router->addRoute("user/resetpw_ask", "Pages\UserPage@reset_ask");
$router->addRoute("user/resetpw", "Pages\UserPage@resetpw");
$router->addRoute("user/resetpw/(.*)", "Pages\UserPage@resetpw_edit");
$router->addRoute("user/confirm/(.*)", "Pages\UserPage@confirm");
$router->addRoute("user/logout", "Pages\UserPage@logout");

$router->addRoute("montage", "Pages\MontagePage@index");


$router->addRoute("dev", "Pages\DevPage@index");
$router->addRoute("dev/mail", "Pages\DevPage@mail");
$router->route($url);