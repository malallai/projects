<?php


namespace Pages;

use Core\Page;
use App\Post\PostController;

class PostPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new PostController($this);
    }

    public function security($args) {
        if (!$this->_controller->getUserController()->isLogged()){
            $this->redirect("/user");
            return false;
        }
        if (!$this->checkToken($args) || !$this->checkPostValues($args, "id") || !$this->_controller->postExist($args['id']))
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
        $result = $this->_controller->like($post, $this->_controller->getUserController()->getSessionId());
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
        $result = $this->_controller->comment($post, $_POST['comment'], $this->_controller->getUserController()->getUserById($this->_controller->getUserController()->getSessionId()));
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
        if ($this->_controller->getPost($post)['result']['user_id'] == $this->_controller->getUserController()->getSessionId()) {
            $result = $this->_controller->delete($post);
            echo json_encode($result);
            return $result;
        } else {
            echo json_encode($nop);
            return $nop;
        }
    }

}