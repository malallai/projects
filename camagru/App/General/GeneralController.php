<?php

namespace App\General;
use App\Post\PostController;
use Core\Controller;
use App\User\UserController;
use Core\Page;
use Core\Session;
use Core\Snackbar;
use Exceptions\SqlException;
use PDO;

class GeneralController extends Controller {
    private $_user_controller;
    private $_post_controller;

    public function __construct($page) {
        $this->_sql = new GeneralSql();
        $this->_user_controller = new UserController($page);
        $this->_post_controller = new PostController($page);
        $this->_page = $page;
    }

    /**
     * @return UserController
     */
    public function getUserController() {
        return $this->_user_controller;
    }

    /**
     * @return PostController
     */
    public function getPostController() {
        return $this->_post_controller;
    }

    /**
     * @return Page
     */
    public function getPage() {
        return $this->_page;
    }

    /**
     * @return GeneralSql
     */
    protected function getSql() {
        return $this->_sql;
    }

    public function getPagesCount() {
        $postsCount = $this->getPostController()->getPostsCount();
        $pages = ceil($postsCount / 5);
        return $pages;
    }

    public function getPosts($page = 1) {
        $postsPerPage = 5;
        $postsCount = $this->getPostController()->getPostsCount();
        $tot = ceil($postsCount / $postsPerPage);
        if(!($page > 0 AND $page <= $tot))
            return false;
        $start = ($page - 1) * $postsPerPage;
        $request = $this->getPostController()->getLimitPostList($start, $postsPerPage);
        return $request['result'];
    }

}