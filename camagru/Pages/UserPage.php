<?php

namespace Pages;
use Core\Page;
class UserPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
    }

    public function index() {
        $exploded = explode('/', $this->_url);
        $this->indexPage(0);
    }

    public function indexPage($page) {
        if ($page === 0) {
            $params = array('content' => 'views/user/User');
            $this->render($params);
        }
    }

    public function login() {
        $params = array('content' => 'views/user/Login');
        $this->render($params);
    }

}