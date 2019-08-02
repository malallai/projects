<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;

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
        header("Content-type: text/plain");
        $posts = $this->getController()->getPosts(1);
        var_dump($this->getController()->getUserController());
        $params = array('content' => 'dev/Test', "posts" => $posts, "users" => $this->getController()->getUserController()->getLastUsers());
        $this->quickRender($params);
    }

    public function mail() {
        $params = array('content' => 'mail/Template');
        $this->render($params);
    }

}