<?php
/**
 * require_once 'core/Autoloader.php';
 * Autoloader::register();
 */
class Autoloader {
    static function register() {
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    static function autoload($class) {
        $class = str_replace('\\', '/', $class);
        require $class . '.php';
    }
}