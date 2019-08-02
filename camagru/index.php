<?php

require 'Core/Autoloader.php';
Autoloader::register();

use Core\Router;

$url = $_GET['url'];

$router = new Router();
$router->addRoute("", "Pages\GeneralPage@index");
$router->addRoute("index", "Pages\GeneralPage@index");

$router->addRoute("page/(\d*)", "Pages\GeneralPage@index");

$router->addRoute("user", "Pages\UserPage@index");

$router->addRoute("user/ask_reset", "Pages\UserPage@askPasswordReset");
$router->addRoute("user/confirm/(.*)", "Pages\UserPage@confirm");
$router->addRoute("user/edit", "Pages\UserPage@edit");
$router->addRoute("user/login", "Pages\UserPage@login");
$router->addRoute("user/logout", "Pages\UserPage@logout");
$router->addRoute("user/register", "Pages\UserPage@register");
$router->addRoute("user/reset_password", "Pages\UserPage@editPassword");
$router->addRoute("user/reset_password/(.*)", "Pages\UserPage@resetPassword");

$router->addRoute("post/like", "Pages\PostPage@like");
$router->addRoute("post/comment", "Pages\PostPage@comment");
$router->addRoute("post/delete", "Pages\PostPage@delete");

$router->addRoute("montage", "Pages\MontagePage@index");


$router->addRoute("dev", "Pages\DevPage@index");
$router->addRoute("dev/mail", "Pages\DevPage@mail");
$router->route($url);