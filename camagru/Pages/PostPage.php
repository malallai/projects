<?php


namespace Pages;

use Core\Page;
use App\Post\PostController;

class PostPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = PostController::get($this);
    }

    public function getController() {
        return $this->_controller;
    }

    function post() {
        $exploded = explode("/", $this->_url);
        if (count($exploded) > 1) {
            $this->seePost(intval($exploded[1]));
        } else {
            Page::redirect("/");
        }
    }

    function seePost($post) {
        $post = $this->getController()->getPost($post);
        $params = array('content' => 'general/Post', 'post' => $post);
        $this->render($params);
    }

    public function security($args) {
        if (!$this->getController()->getUserController()->isLogged()){
            return array("status" => "log error");
        }
        if (!$this->checkToken($args))
            return array("status" => "token error");
        if (!$this->checkPostValues($args, "id") || !$this->getController()->postExist($args['id']))
            return array("status" => "post error");
        return true;
    }


    public function like() {
        header("Content-type: text/plain");
        if (($nop = $this->security($_POST)) !== true) {
            echo json_encode($nop);
            return $nop;
        }
        $post = $_POST['id'];
        $result = $this->getController()->like($post, $this->getController()->getUserController()->getSessionId());
        echo json_encode($result);
        return $result;
    }

    public function comment() {
        header("Content-type: text/plain");
        if (($nop = $this->security($_POST)) !== true) {
            echo json_encode($nop);
            return $nop;
        }
        if (empty($_POST['comment'])) {
            echo json_encode($nop = array("status" => "empty comment error"));
            return $nop;
        }
        $post = $_POST['id'];
        $result = $this->getController()->comment($post, $_POST['comment'], $this->getController()->getUserController()->getUserById($this->getController()->getUserController()->getSessionId()));
        echo json_encode($result);
        return $result;
    }

    public function delete() {
        header("Content-type: text/plain");
        if (($nop = $this->security($_POST)) !== true) {
            echo json_encode($nop);
            return $nop;
        }
        $post = $_POST['id'];
        if ($this->getController()->getPost($post)['post']['user_id'] == $this->getController()->getUserController()->getSessionId()) {
            $result = $this->getController()->delete($post);
            echo json_encode($result);
            return $result;
        } else {
            echo json_encode($nop = array("status" => "delete error"));
            return $nop;
        }
    }

}