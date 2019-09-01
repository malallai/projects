<?php

namespace Core;

use App\Setup\SetupController;
use App\User\UserController;
use ReflectionException;
use ReflectionClass;

class Router {
    private $_routes = [];

    public function addRoute($url, $params, $bypassSetup = false) {
        $this->_routes[$url] = array('params' => $params, 'bypassSetup' => $bypassSetup);
    }

    public function route($url) {
        error_log("Connection on ".$url, 0);
        foreach ($this->_routes as $key => $value) {
            if (preg_match("#^" . $key . "(\/?)$#", $url) === 1) {
                if (SetupController::isSetup() || (!SetupController::isSetup() && $value['bypassSetup'])) {
                    $exploded = explode("@", $value['params']);
                    try {
                        $reflectionClass = new ReflectionClass($exploded[0]);
                        $controller = $reflectionClass->newInstanceArgs([$this, $url]);
                        $method = $reflectionClass->getMethod($exploded[1]);
                        $method->invoke($controller);
                        return;
                    } catch (ReflectionException $e) {
                        Snackbar::sendSnacks($e->getMessage());
                        Page::redirect("/");
                    }
                } else {
                    Snackbar::sendSnacks("La BDD n'a pas été configuré correctement. Merci de contacter un administrateur.");
                    Page::redirect("/");
                }
            }
        }
        $this->notFound($url);
    }

    public function notFound($url, $redirect = true) {
        header('HTTP/1.0 404 Not Found');
        Snackbar::sendSnack("Error '".$url."' not found. Please contact us. (404)");
        if ($redirect) {
            Page::redirect("/");
        }
    }

}