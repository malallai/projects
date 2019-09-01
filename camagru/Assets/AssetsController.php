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
        $default = "Public/assets/pictures/default.jpg";
        if (!file_exists($default))
            die();
        header('Content-type: image/jpeg');
        readfile($default);
    }

}