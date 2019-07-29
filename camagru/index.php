<?php

require 'Core/Autoloader.php';
Autoloader::register();

use Pages\GeneralPage;
use Core\Router;

$url = $_GET['url'];

$router = new Router();
$router->addRoute("", "Pages\GeneralPage@index");
$router->addRoute("index", "Pages\GeneralPage@index");

$router->addRoute("page/(\d*)", "Pages\GeneralPage@index");

$router->addRoute("user", "Pages\UserPage@index");

$router->addRoute("user/login", "Pages\UserPage@login");
$router->addRoute("user/register", "Pages\UserPage@register");
$router->addRoute("user/resetpw_ask", "Pages\UserPage@resetAsk");
$router->addRoute("user/resetpw", "Pages\UserPage@resetpw");
$router->addRoute("user/resetpw/(.*)", "Pages\UserPage@resetPwdEdit");
$router->addRoute("user/confirm/(.*)", "Pages\UserPage@confirm");
$router->addRoute("user/logout", "Pages\UserPage@logout");
$router->addRoute("user/edit", "Pages\UserPage@edit");

$router->addRoute("post/like", "Pages\PostPage@like");
$router->addRoute("post/comment", "Pages\PostPage@comment");
$router->addRoute("post/delete", "Pages\PostPage@delete");

$router->addRoute("montage", "Pages\MontagePage@index");


$router->addRoute("dev", "Pages\DevPage@index");
$router->addRoute("dev/mail", "Pages\DevPage@mail");
$router->route($url);