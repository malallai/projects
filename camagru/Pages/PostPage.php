<?php


namespace Pages;

use Core\Page;
use App\General\Post\PostController;
use Core\Router;

class PostPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new PostController();
    }

    public function like() {
        $exploded = explode("/", $this->_url);
        $postid = $exploded[1];
        if (!$this->_controller->getSql()->postExist($postid))
            return (false);
        $this->_controller->getSql()->like($postid, $this->_controller->getGeneralController()->getUserController()->getSessionId());
        return (true);
    }

    public function comment() {

    }

    public function delete() {

    }

}