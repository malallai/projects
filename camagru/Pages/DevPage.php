<?php

namespace Pages;
use Core\Page;
class DevPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";

    }

    public function index() {
        $params = array('content' => 'dev/Test');
        $this->render($params);
    }

    public function mail() {
        $params = array('content' => 'mail/Template');
        $this->render($params);
    }

}