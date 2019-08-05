<?php

namespace App\Post;

use App\User\UserController;
use Core\Controller;
use Core\Mail;
use Core\Page;

class PostController extends Controller {

    private $_userController;
    protected static $_instance = null;

    public function __construct($page) {
        if (self::$_instance === null) {
            self::$_instance = $this;
            $this->_sql = new PostSql();
            $this->_page = $page;
            $this->_userController = UserController::get($page);
        }
    }

    /**
     * @var page Page
     * @return PostController
     */
    public static function get($page) {
        if (self::$_instance === null)
            return new PostController($page);
        return self::$_instance;
    }

    /**
     * @return Page
     */
    public function getPage() {
        return $this->_page;
    }

    /**
     * @return UserController
     */
    public function getUserController() {
        return $this->_userController;
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

    public function getPost($postId) {
        return array("post" => $this->getSql()->getPost($postId)['result'], "comments" => $this->getSql()->getComments($postId)['result']);
    }

    public function isLiked($postId, $userId) {
        return $this->getSql()->isLiked($postId, $userId);
    }

    public function like($post, $user) {
        return $this->getSql()->like($post, $user);
    }

    public function getPostsCount() {
        return $this->getSql()->getPostsCount();
    }

    public function getLimitPostList($start, $limit) {
        return $this->getSql()->getLimitPostList($start, $limit);
    }

    public function comment($post, $message, $user) {
        if ($this->getSql()->canComment($user['id'])) {
            if ($this->getSql()->comment($post, $message, $user['id'])) {
                $author = $this->getSql()->getPostAuthor($post);
                if ($author['notifications'] && $author['username'] !== $user['username']) {
                    Mail::newMail($author['email'], "Nouveau commentaire",
                        "Un commentaire à été ajouté sur l'une de vos images.".
                        "</br></br>".
                        "".$user['username']." : ".$message.
                        "</br></br>".
                        "Merci de ta confiance et à bientôt sur Camagru."
                    );
                }
                return array("status" => "ok", "message" => $message, "author" => $user['username']);
            } else {
                return array("status" => false);
            }
        } else {
            return array("status" => "spam");
        }
    }

    public function delete($post) {
        return $this->getSql()->delete($post);
    }

    public function getUserPosts($id) {
        $result = $this->getSql()->getUserPosts($id);
        return $result['result'];
    }

}