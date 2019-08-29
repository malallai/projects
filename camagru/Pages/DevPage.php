<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;

class DevPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_controller = GeneralController::get($this);
        $this->_template = "templates/general";
    }

    /**
     * @return GeneralController
     */
    public function getController() {
        return $this->_controller;
    }

    public function index() {
        $params = array('content' => 'dev/Test');
        $this->render($params);
    }

    public function debug() {
	    header('Content-type: text/plain');
    }

    public function mail() {
        $params = array('content' => 'mail/Template');
        $this->render($params);
    }

    public function landing() {
        $params = array('content' => 'general/Landing');
        $this->render($params);
    }

}
