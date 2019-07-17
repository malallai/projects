<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;
class GeneralPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
        $this->_controller = new GeneralController();
    }

    public function index() {
        $exploded = explode('/', $this->_url);
        $this->indexPage(0);
    }

    public function indexPage($page) {
        if ($page === 0) {
            $this->getPosts(1);
            $params = array('content' => 'general/Home');
            $this->render($params);
        }
    }

    public function dev() {
        $params = array('content' => 'dev/Test');
        $this->render($params);
    }



}