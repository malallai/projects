<?php

namespace Core;

class Router {
    private $_routes = [];

    public function addRoute($url, $params) {
        $this->_routes[$url] = $params;
    }

    public function route($url) {
        foreach ($this->_routes as $key => $value) {
            if (preg_match("#^" . $key . "(\/?)$#", $url) === 1) {
                $exploded = explode("@", $value);
                $reflectionClass = new \ReflectionClass($exploded[0]);
                $controller = $reflectionClass->newInstanceArgs([$this, $url]);
                $method = $reflectionClass->getMethod($exploded[1]);
                $method->invoke($controller);
                return;
            }
        }
        $this->notFound($url);
    }

    public function notFound($url, $redirect = true) {
        header('HTTP/1.0 404 Not Found');
        Snackbar::send_snack("Error '".$url."' not found. Please contact us. (404)");
        if ($redirect) {
            Page::redirect("/");
        }
    }

}