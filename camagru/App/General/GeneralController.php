<?php

namespace App\General;
use Core\Controller;
use App\User\UserController;
use Core\Page;
use Core\Session;
use Core\Snackbar;
use Exceptions\SqlException;
use PDO;

class GeneralController extends Controller {
    private $_user_controller;

    public function __construct($page) {
        $this->_sql = new GeneralSql();
        $this->_user_controller = new UserController($page);
        $this->_page = $page;
    }

    /**
     * @return UserController
     */
    public function getUserController() {
        return $this->_user_controller;
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

    public static function compareTokens($token) {
        Session::startSession();
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            if ($_SESSION['token'] === $token) {
                return true;
            }
        }
        return false;
    }

    public function getPostDetails($postId) {
        return array("post" => $this->getSql()->getPost($postId)['result'], "comments" => $this->getSql()->getComments($postId)['result']);
    }

    public function getUserDetails($user) {
        return $this->getSql()->getUser($user)['result'];
    }

    public function isLiked($postId) {
        if (!$this->getUserController()->isLogged())
            return false;
        return $this->getSql()->isLiked($postId, $this->getUserController()->getSessionId());
    }

    public function getPosts($page = 1) {
        $postsPerPage = 5;
        $postsCount = $this->getSql()->getPostsCount();
        $tot = ceil($postsCount / $postsPerPage);
        if(!($page > 0 AND $page <= $tot))
            return false;
        $start = ($page - 1) * $postsPerPage;
        $request = $this->getSql()->getLimitPostList($start, $postsPerPage);
        return $request['result'];
    }

    public function getPagesCount() {
        $postsCount = $this->getSql()->getPostsCount();
        $pages = ceil($postsCount / 5);
        return $pages;
    }

}