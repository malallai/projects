<?php

namespace App\Post;

use App\General\GeneralController;
use Core\Controller;
use Core\Page;
use Core\Security;

class PostController extends Controller {

    private $_generalController;

    public function __construct($page) {
        $this->_sql = new PostSql();
        $this->_generalController = new GeneralController($page);
        $this->_page = $page;
    }

    /**
     * @return Page
     */
    public function getPage() {
        return $this->_page;
    }

    /**
     * @return GeneralController
     */
    public function getGeneralController() {
        return $this->_generalController;
    }

    /**
     * @return PostSql
     */
    public function getSql() {
        return $this->_sql;
    }

    public function postExist($id) {
        return $this->getSql()->postExist($id);
    }

    public function getPostDetails($postId) {
        return array("post" => $this->getSql()->getPost($postId)['result'], "comments" => $this->getSql()->getComments($postId)['result']);
    }

    public function isLiked($postId, $userId) {
        return $this->getSql()->isLiked($postId, $userId);
    }

}