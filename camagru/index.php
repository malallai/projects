<?php

require 'Core/Autoloader.php';
Autoloader::register();

use Core\Router;

$url = $_GET['url'];

$router = new Router();

$router->addRoute("Public/assets/pictures/default", "Assets\AssetsController@defaultPic");
$router->addRoute("Public/assets/pictures/(.*)", "Assets\AssetsController@route");

$router->addRoute("", "Pages\GeneralPage@index", true);
$router->addRoute("index", "Pages\GeneralPage@index", true);

$router->addRoute("page/(\d*)", "Pages\GeneralPage@index");

$router->addRoute("user", "Pages\UserPage@index");

$router->addRoute("user/ask_reset", "Pages\UserPage@askPasswordReset");
$router->addRoute("user/confirm/(.*)", "Pages\UserPage@confirm");
$router->addRoute("user/edit", "Pages\UserPage@edit");
$router->addRoute("user/login", "Pages\UserPage@login");
$router->addRoute("user/logout", "Pages\UserPage@logout");
$router->addRoute("user/register", "Pages\UserPage@register");
$router->addRoute("user/reset_password", "Pages\UserPage@resetPassword");
$router->addRoute("user/reset_password/(.*)", "Pages\UserPage@editPassword");

$router->addRoute("post/like", "Pages\PostPage@like");
$router->addRoute("post/comment", "Pages\PostPage@comment");
$router->addRoute("post/delete", "Pages\PostPage@delete");
$router->addRoute("post/(\d*)", "Pages\PostPage@post");

$router->addRoute("montage", "Pages\MontagePage@index");
$router->addRoute("montage/upload", "Pages\MontagePage@upload");

$router->addRoute("setup", "Pages\SetupPage@setup", true);

$router->addRoute("dev/debug", "Pages\SetupPage@debug", true);

$router->route($url);