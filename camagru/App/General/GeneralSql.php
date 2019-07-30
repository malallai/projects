<?php


namespace App\General;
use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;
use Pages\DevPage;
use PDO;

class GeneralSql extends Sql {

    public function getLimitPostList($offset, $fetch) {
        try {
            $request = self::bindValueRunList("SELECT * FROM posts ORDER BY date DESC LIMIT :offset, :fetch",  array("offset" => array($offset, PDO::PARAM_INT), "fetch" => array($fetch, PDO::PARAM_INT)), PDO::FETCH_ASSOC);
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getPostsCount() {
        /** @var $statement \PDOStatement */
        try {
            $posts = self::run("SELECT id FROM posts", array());
            $statement = $posts['statement'];
            $postsCount = $statement->rowCount();
            return $postsCount;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getPost($id) {
        try {
            $request = self::run("SELECT posts.*, users.username, count(likes.post_id) AS likes FROM posts INNER JOIN users ON posts.user_id = users.id LEFT JOIN likes AS likes ON likes.post_id = posts.id WHERE posts.id = ?",  array($id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getComments($id) {
        try {
            $request = self::runList("SELECT comments.comment, users.username FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.post_id = ?",  array($id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function isLiked($id, $user) {
        try {
            $request = self::run("SELECT COUNT(*) FROM likes WHERE likes.post_id = ? AND likes.user_id = ?", array($id, $user));
            return ($request['result'][0] == 1 ? true : false);
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getUser($id) {
        try {
            $request = self::run("SELECT users.*, (SELECT COUNT(*) FROM posts WHERE posts.user_id = ?) AS posts FROM users WHERE users.id = ?",  array($id, $id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

}