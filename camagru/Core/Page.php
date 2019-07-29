<?php

namespace Core;
class Page {

    /**
     * @type Router
     */
    protected $_router;
    protected $_url;
    protected $_template;
    protected $_controller;

    public function __construct($router, $url = "") {
        $this->_router = $router;
        $this->_url = $url;
    }

    public static function redirect($loc) {
        header("Location: " . $loc);
        die();
    }

    public function render($params) {
        Session::startSession();
        $token = bin2hex(random_bytes(50));
        $_SESSION['token'] = $token;
        ob_start();
        require "Public/views/" . $params['content'] . '.php';
        $content = ob_get_clean();
        if (Snackbar::hasSnack()) {
            $content .= Snackbar::renderSnacks();
        }
        $_logged = isset($_SESSION['user']) ? true : false;
        require "Public/views/" . $this->_template . '.php';
    }

    public function quickRender($params) {
        Session::startSession();
        ob_start();
        require "Public/views/" . $params['content'] . '.php';
        $content = ob_get_clean();
        return $content;
    }

}