<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;
use Core\Snackbar;

class DevPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_controller = new GeneralController($this);
        $this->_template = "templates/general";

    }

    /**
     * @return GeneralController
     */
    public function getController() {
        return $this->_controller;
    }

    public function index() {
        $posts = $this->getController()->getSql()->getPosts(1);
        $params = array('content' => 'dev/Test', "posts" => $posts);
        $this->render($params);
    }

    public function mail() {
        $params = array('content' => 'mail/Template');
        $this->render($params);
    }

}