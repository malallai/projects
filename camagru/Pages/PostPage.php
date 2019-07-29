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

    public function security($args) {
        if (!$this->_controller->getGeneralController()->getUserController()->isLogged()){
            $this->redirect("/user");
            return false;
        }
        if (!isset($args['id']) || !isset($args['token']) || !GeneralController::compareTokens($args['token'])
            || !$this->_controller->getSql()->postExist($args['id']))
            return false;
        return true;
    }

    public function like() {
        if (!$this->security($_POST)) {
            echo 0;
            return false;
        }
        $post = $_POST['id'];
        header("Content-type: text/plain");
        $result = $this->_controller->getSql()->like($post, $this->_controller->getGeneralController()->getUserController()->getSessionId());
        echo $result;
        return ($result);
    }

    public function comment() {
        if (!$this->security($_POST)) {
            echo 0;
            return false;
        }
        header("Content-type: text/plain");
        $test = array("author" => "malallai", "message" => "jdwopajdpwa");
        echo json_encode($test);
    }

    public function delete() {
        if (!$this->security($_POST)) {
            echo 0;
            return false;
        }
        header("Content-type: text/plain");
        $post = $_POST['id'];
        if ($this->_controller->getGeneralController()->getSql()->getPost($post)['result']['user_id'] == $this->_controller->getGeneralController()->getUserController()->getSessionId()) {
            $result = $this->_controller->getSql()->delete($post);
            echo $result;
            return $result;
        } else {
            echo 0;
            return false;
        }
    }

}