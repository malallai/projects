<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;
use Core\Snackbar;

class GeneralPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
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
        $posts = $this->_controller->getSql()->getPosts($page);
        $users = $this->_controller->getUserController()->getSql()->getLastUsers();
        Snackbar::send_snack("RENDER");
        Snackbar::send_snack(DevPage::renderArray($posts));
        Snackbar::send_snack("RENDERED?");
        $params = array('content' => 'general/Home', 'posts' => $posts, 'users' => $users);
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

}