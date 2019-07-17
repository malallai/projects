<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;
class GeneralPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
        $this->_controller = new GeneralController();
    }

    public function index() {
        $exploded = explode('/', $this->_url);
        $this->indexPage(0);
    }

    public function indexPage($page) {
        if ($page === 0) {
            $this->getPosts(1);
            $params = array('content' => 'general/Home');
            $this->render($params);
        }
    }

    public function dev() {
        $params = array('content' => 'dev/Test');
        $this->render($params);
    }

    public function getPosts($page = 1) {
        $postsPerPage = 5;
        $posts = $this->_controller->getSql()->prepare("SELECT id FROM posts");
        $postsCount = $posts->rowCount();
        $tot = ceil($postsCount / $postsPerPage);
        if(!($page > 0 AND $page <= $tot))
            return false;
        $start = ($page - 1) * $postsPerPage;
        //$this->_controller->getSql()->prepare("SELECT posts.*, users.username, (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
        $result = $this->_controller->getSql()->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT ?,?", array($start, $postsPerPage));
        var_dump($result);
    }

}