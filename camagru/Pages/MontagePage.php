<?php


namespace Pages;

use Core\Page;
use App\User\UserController;
use App\Montage\MontageController;
class MontagePage extends Page  {
    private $_userController;

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = MontageController::get($this);
        $this->_userController = UserController::get($this);
    }

    public function getController() {
        return $this->_controller;
    }

    public function getUserController() {
        return $this->_userController;
    }

    public function security($args) {
        if (!$this->getController()->getUserController()->isLogged()){
            return array("status" => "log error");
        }
        if (!$this->checkToken($args))
            return array("status" => "token error");
        return true;
    }

    public function index() {
        if (!$this->getUserController()->isLogged())
            Page::redirect('/user');
        $params = array('content' => 'general/Montage');
        $this->render($params);
    }

    public function upload() {
        header("Content-type: text/plain");
        if (($nop = $this->security($_POST)) !== true) {
            echo json_encode($nop);
            return $nop;
        }
        if ($this->checkPostValues($_POST, "img", "filter", "offW", "offH")) {
            if ($_POST['filter'] === "42" && !$this->checkPostValues($_POST, "img", "filter", "offWF", "offHF", "filterPicture", "filterX", "filterY")) {
                echo json_encode(array("status" => "post error 2"));
                return false;
            }
            $result = $this->getController()->newPost($_POST);
            echo json_encode($result);
            return $result;
        }
        echo json_encode(array("status" => "post error 3"));
        return false;
    }

}