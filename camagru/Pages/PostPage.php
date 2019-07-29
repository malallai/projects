<?php


namespace Pages;

use Core\Page;
use App\Post\PostController;

class PostPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new PostController();
    }

    public function like() {
        $exploded = explode("/", $this->_url);
        $postid = $exploded[1];
        if (!$this->_controller->getGeneralController()->getUserController()->isLogged() || !$this->_controller->getSql()->postExist($postid)) {
            echo false;
            return false;
        }
        $result = $this->_controller->getSql()->like($postid, $this->_controller->getGeneralController()->getUserController()->getSessionId());
        echo $result;
        return ($result);
    }

    public function comment() {

    }

    public function delete() {

    }

}