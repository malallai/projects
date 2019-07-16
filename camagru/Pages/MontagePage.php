<?php


namespace Pages;

use Core\Page;
use App\Montage\MontageController;

class MontagePage extends Page  {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
        $this->_controller = new MontageController();
    }

    public function index() {
        $params = array('content' => 'general/Montage');
        $this->render($params);
    }

}