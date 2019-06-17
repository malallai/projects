<?php

namespace Pages;
use Core\Page;
class ProfilePage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
    }

    public function index() {
        $params = array('content' => 'profile/Profile');
        $this->render($params);
    }

}