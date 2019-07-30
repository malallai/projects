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
        header("Content-type: text/plain");
        $nop = array("status" => 0);
        if (!$this->security($_POST)) {
            echo json_encode($nop);
            return $nop;
        }
        $post = $_POST['id'];
        $result = $this->_controller->getSql()->like($post, $this->_controller->getGeneralController()->getUserController()->getSessionId());
        echo json_encode($result);
        return $result;
    }

    public function comment() {
        header("Content-type: text/plain");
        $nop = array("status" => 0);
        if (!$this->security($_POST)) {
            echo json_encode($nop);
            return $nop;
        }
        $post = $_POST['id'];
        $result = $this->_controller->getSql()->newComment($post, $_POST['comment'], $this->_controller->getGeneralController()->getUserController()->getUser());
        echo json_encode($result);
        return $result;
    }

    public function delete() {
        header("Content-type: text/plain");
        $nop = array("status" => 0);
        if (!$this->security($_POST)) {
            echo json_encode($nop);
            return $nop;
        }
        $post = $_POST['id'];
        if ($this->_controller->getGeneralController()->getSql()->getPost($post)['result']['user_id'] == $this->_controller->getGeneralController()->getUserController()->getSessionId()) {
            $result = $this->_controller->getSql()->delete($post);
            echo json_encode($result);
            return $result;
        } else {
            echo json_encode($nop);
            return $nop;
        }
    }

}