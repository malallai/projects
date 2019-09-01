<?php

namespace Assets;
class AssetsController {

    private $_router;
    private $_url;

    public function __construct($router, $url) {
        $this->_router = $router;
        $this->_url = $url;
    }

    public function route() {
        if (!file_exists($this->_url))
            die();
    }

}