<?php

namespace App\Post;

use App\General\GeneralController;
use Core\Controller;
use Core\Mail;
use Core\Page;

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

    public function getPost($postId) {
        return array("post" => $this->getSql()->getPost($postId)['result'], "comments" => $this->getSql()->getComments($postId)['result']);
    }

    public function isLiked($postId, $userId) {
        return $this->getSql()->isLiked($postId, $userId);
    }

    public function like($post, $user) {
        return $this->getSql()->like($post, $user);
    }

    public function comment($post, $message, $user) {
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
    }

    public function delete($post) {
        return $this->getSql()->delete($post);
    }

}