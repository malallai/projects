<?php


namespace Pages;

use Core\Page;
use App\Montage\MontageController;

class MontagePage extends Page  {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = MontageController::get($this);
    }

    /**
     * @return MontageController
     */
    public function getController() {
        return $this->_controller;
    }

    public function index() {
        $params = array('content' => 'general/Montage');
        $this->render($params);
    }



}