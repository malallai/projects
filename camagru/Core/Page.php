<?php

namespace Core;

class Page {

    protected $_router;
    protected $_url;
    protected $_template;
    protected $_controller;

    public function __construct($router, $url = "") {
        $this->_router = $router;
        $this->_url = $url;
    }

    public static function redirect($loc, ...$snack) {
        if ($snack) {
            $array = func_get_args();
            unset($array[0]);
            foreach ($array as $message)
                Snackbar::sendSnack($message);
        }
        header("Location: " . $loc);
        die();
    }

    public function render($params) {
        Session::startSession();
        $token = bin2hex(random_bytes(50));
        error_log($token." connected.", 0);
        $_SESSION['token'] = $token;
        ob_start();
        require "Public/views/" . $params['content'] . '.php';
        $content = ob_get_clean();
        if (Snackbar::hasSnack()) {
            $content .= Snackbar::renderSnacks();
        }
        require "Public/views/" . $this->_template . '.php';
    }

    public function quickRender($params) {
        Session::startSession();
        ob_start();
        require "Public/views/" . $params['content'] . '.php';
        $content = ob_get_clean();
        return $content;
    }

    public function checkToken($post) {
        if (isset($post) && isset($post['token']) && Security::compareTokens($post['token']))
            return true;
        return false;
    }

    public function checkPostValues($post, ...$values) {
        if (!isset($post))
            return false;
        else {
            $array = func_get_args();
            unset($array[0]);
            foreach ($array as $key => $value) {
                if (!isset($post[''.$value]) || empty($post[''.$value]))
                    return false;
            }
        }
        return true;
    }

}