<?php

namespace App\General;
use App\Post\PostController;
use Core\Controller;
use App\User\UserController;

class GeneralController extends Controller {
    private $_user_controller;
    private $_post_controller;
    protected static $_instance = null;

    public function __construct($page) {
        if (self::$_instance === null) {
            self::$_instance = $this;
            $this->_sql = new GeneralSql();
            $this->_page = $page;
            $this->_user_controller = UserController::get($page);
            $this->_post_controller = PostController::get($page);
        }
    }

    public static function get($page) {
        if (self::$_instance === null)
            return new GeneralController($page);
        return self::$_instance;
    }

    public function getUserController() {
        return $this->_user_controller;
    }

    public function getPostController() {
        return $this->_post_controller;
    }

    public function getPage() {
        return $this->_page;
    }

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