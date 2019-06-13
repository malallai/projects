<?php

namespace Core;
class Page {

    protected $_url;
    protected $_template;

    public function __construct($url = "") {
        $this->_url = $url;
    }

    public function redirect($loc) {
        header("Location: " . $loc);
        die();
    }

    public function render($params) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $token = bin2hex(random_bytes(50));
        $_SESSION['token'] = $token;
        ob_start();
        require $params['content'] . '.php';
        $content = ob_get_clean();
        $_logged = isset($_SESSION['user']) ? true : false;
        require $this->_template . '.php';
    }

}