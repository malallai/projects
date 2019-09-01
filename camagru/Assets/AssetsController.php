<?php

namespace Assets;
use Core\Page;

class AssetsController {

    private $_router;
    private $_url;

    public function __construct($router, $url) {
        $this->_router = $router;
        $this->_url = $url;
    }

    public function route() {
        if (!file_exists($this->_url))
            Page::redirect("/Public/assets/pictures/default");
    }

    public function defaultPic() {
        if (!file_exists("Public/assets/pictures/default.jpg"))
            die();
    }

}