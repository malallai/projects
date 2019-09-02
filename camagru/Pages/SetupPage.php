<?php

namespace Pages;
use Core\Page;
use App\Setup\SetupController;
use Core\Security;

class SetupPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/landing";
        $this->_controller = SetupController::get($this);
    }

    public function getController() {
        return $this->_controller;
    }

    public function setup() {
        if (SetupController::isSetup())
            Page::redirect("/", "Camagru est déjà configuré. Vous pouvez en profiter plainement.");
        if ($this->checkToken($_POST)) {
            if ($this->checkPostValues($_POST, "submit")) {
                if ($this->getController()->setup())
                    Page::redirect("/");
                return;
            }
        }
        $params = array('content' => 'landing/setup');
        $this->render($params);
    }

    public function debug() {
        header("Content-Type: text/plain");
        echo Security::newToken(8);
    }

}