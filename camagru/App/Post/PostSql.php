<?php

namespace App\Post;

use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;
use PDO;

class PostSql extends Sql {

    public function postExist($id) {
        try {
            $result = self::run("SELECT COUNT(*) FROM posts WHERE id = ?", array($id));
            return ($result['result'][0] == 1 ? true : false);
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getLikeCount($post) {
        try {
            $result = self::run("SELECT COUNT(likes.post_id) FROM likes WHERE post_id = ?", array($post));
            return ($result['result'][0]);
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function like($id, $user) {
        try {
            $result = self::run("SELECT COUNT(*) FROM likes WHERE post_id = ? AND user_id = ?", array($id, $user));
            if ($result['result'][0] == 1) {
                self::run("DELETE FROM likes WHERE post_id = ? AND user_id = ?", array($id, $user));
                return array("status" => "unlike", "likes" => $this->getLikeCount($id));
            } else {
                self::run("INSERT INTO likes (post_id, user_id) VALUES(?, ?)", array($id, $user));
                return array("status" => "like", "likes" => $this->getLikeCount($id));
            }
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getPostAuthor($post) {
        try {
            $result = self::run("SELECT posts.user_id, users.username, users.email, users.notifications FROM posts INNER JOIN users ON users.id = posts.user_id WHERE posts.id = ?", array($post));
            return ($result['result']);
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function comment($post, $message, $user) {
        try {
            self::run("INSERT INTO comments (post_id, user_id, comment) VALUES(?,?,?)", array($post, $user, $message));
            self::run("INSERT INTO timer (user_id) VALUES (?) ON DUPLICATE KEY UPDATE last_comment = current_timestamp", array($user));
            return true;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function canComment($user) {
        try {
            $result = self::run("SELECT last_comment FROM timer INNER JOIN users ON users.id = ? WHERE date_add(last_comment, INTERVAL 5 SECOND) > current_timestamp AND user_id = users.id AND EXISTS(SELECT * FROM timer WHERE user_id = users.id)", array($user));
            if (!isset($result['result']) || empty($result['result']))
                return true;
        } catch (SqlException $e) {
            Snackbar::sendSnacks($e->getMessage());
        }
        return false;
    }

    public function delete($post) {
        try {
            self::run("DELETE FROM posts WHERE id = ?", array($post));
            return array("status" => "deleted");
        } catch (SqlException $exception) {
            Snackbar::sendSnack($exception->getMessage());
        }
    }

    public function getUserPosts($id) {
        try {
            $request = self::runList("SELECT posts.*, (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.id = ? ORDER BY date DESC", array($id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return null;
        }
    }

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
            $request = self::run("SELECT posts.*, users.username, users.avatar, count(likes.post_id) AS likes FROM posts INNER JOIN users ON posts.user_id = users.id LEFT JOIN likes AS likes ON likes.post_id = posts.id WHERE posts.id = ?",  array($id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getComments($id) {
        try {
            $request = self::runList("SELECT users.username, comments.comment, comments.date FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY date",  array($id));
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

}