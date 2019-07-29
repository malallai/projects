<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;
use Core\Snackbar;

class GeneralPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new GeneralController();
    }

    public function index() {
        $exploded = explode("/", $this->_url);
        if (count($exploded) > 1) {
            $this->indexPage(intval($exploded[1]));
        } else {
            $this->indexPage(1);
        }
    }

    public function indexPage($page) {
        $pages = $this->_controller->getSql()->getPages();
        if ($page > $pages) {
            $page = $pages;
            $this->_router->notFound($this->_url, false);
        }
        $posts = $this->_controller->getSql()->getPosts($page);
        $users = $this->_controller->getUserController()->getSql()->getLastUsers();
        $params = array('content' => 'general/Home', 'posts' => $posts, 'users' => $users, 'page' => $page, 'pages' => $pages);
        $this->render($params);
    }

    public function dev() {
        $params = array('content' => 'dev/Test');
        $this->render($params);
    }

    public function getPostDetails($idPost) {
        return $this->_controller->getSql()->getPost($idPost)['result'];
    }

    public function getUserDetails($user) {
        return $this->_controller->getSql()->getUser($user)['result'];
    }

    public function pagination($globalParams) {
        $params = array('content' => 'general/Pagination', 'page' => $globalParams['page'], 'pages' => $globalParams['pages']);
        $quick_content = $this->quickRender($params);
        return $quick_content;
    }

}