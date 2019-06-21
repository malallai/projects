<?php

namespace Core;
class Page {

    protected $_url;
    protected $_template;
    protected $_controller;

    public function __construct($url = "") {
        $this->_url = $url;
    }

    public function redirect($loc) {
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
        if (Snackbar::has_snack()) {
            $content .= Snackbar::render_snacks();
        }
        $_logged = isset($_SESSION['user']) ? true : false;
        require "Public/views/" . $this->_template . '.php';
    }

}