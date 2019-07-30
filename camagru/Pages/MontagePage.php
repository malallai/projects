<?php


namespace Pages;

use Core\Page;
use App\Montage\MontageController;
use Core\Snackbar;

class MontagePage extends Page  {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new MontageController($this);
    }

    public function index() {
        $params = array('content' => 'general/Montage');
        $this->render($params);
    }



}