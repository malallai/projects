<?php


namespace Pages;

use App\General\GeneralController;
use Core\Page;
use App\Post\PostController;
use Core\Snackbar;

class PostPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new PostController();
    }

    public function like() {
        if (!isset($_POST['id']) || !isset($_POST['token']) || !GeneralController::compareTokens($_POST['token'])) {
            echo 0;
            return false;
        }
    $postid = $_POST['id'];
        header("Content-type: text/plain");
        if (!$this->_controller->getGeneralController()->getUserController()->isLogged() || !$this->_controller->getSql()->postExist($postid)) {
            echo 0;
            return false;
        }
        $result = $this->_controller->getSql()->like($postid, $this->_controller->getGeneralController()->getUserController()->getSessionId());
        echo $result.'';
        return ($result);
    }

    public function comment() {

    }

    public function delete() {

    }

}