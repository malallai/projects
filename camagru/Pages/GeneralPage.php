<?php

namespace Pages;
use App\General\GeneralController;
use App\Setup\SetupController;
use Core\Page;

class GeneralPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = GeneralController::get($this);
    }

    public function getController() {
        return $this->_controller;
    }

    public function index() {
        $posts = !SetupController::isSetup() ? 0 : $this->getController()->getPostController()->getPostsCount();
        if ($posts === 0) {
            $this->_template = "templates/landing";
            $params = array('content' => "landing/Home");
            $this->render($params);
            return;
        }
        $exploded = explode("/", $this->_url);
        if (count($exploded) > 1) {
            $this->indexPage(intval($exploded[1]));
        } else {
            $this->indexPage(1);
        }
    }

    public function indexPage($page) {
        $pages = $this->getController()->getPagesCount();
        if ($page > $pages) {
            $page = $pages;
            $this->_router->notFound($this->_url, false);
        }
        $posts = $this->getController()->getPosts($page);
        $users = $this->getController()->getUserController()->getLastUsers();
        $params = array('content' => 'general/Home', 'posts' => $posts, 'users' => $users, 'page' => $page, 'pages' => $pages);
        $this->render($params);
    }

    public function dev() {
        $params = array('content' => 'dev/Test');
        $this->render($params);
    }

    public function pagination($globalParams) {
        $params = array('content' => 'general/Pagination', 'page' => $globalParams['page'], 'pages' => $globalParams['pages']);
        $quick_content = $this->quickRender($params);
        return $quick_content;
    }

}