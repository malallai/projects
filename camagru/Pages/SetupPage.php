<?php

namespace Pages;
use Core\Page;
use App\Setup\SetupController;
use Core\Security;

class SetupPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = SetupController::get($this);
    }

    /**
     * @return SetupController
     */
    public function getController() {
        return $this->_controller;
    }

    public function setup() {
        if ($this->checkToken($_POST)) {
            if ($this->checkPostValues($_POST, "submit")) {
                if ($this->getController()->setup())
                    Page::redirect("/");
                else
                    Page::redirect("/setup");
                return;
            }
        }
        $params = array('content' => 'setup/setup');
        $this->render($params);
    }

}