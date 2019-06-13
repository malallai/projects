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
                $controller = $reflectionClass->newInstanceArgs([$url]);
                $method = $reflectionClass->getMethod($exploded[1]);
                $method->invoke($controller);
                return;
            }
        }
        header('HTTP/1.0 404 Not Found');
        echo "<h1 style='text-align:center;'>Casses toi pd</h1>";
    }

}