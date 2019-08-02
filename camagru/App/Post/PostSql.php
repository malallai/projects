<?php

namespace App\Post;

use Core\Mail;
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

    public function newComment($post, $message, $user) {
        try {
            $result = self::run("INSERT INTO comments (post_id, user_id, comment) VALUES(?,?,?)", array($post, $user['id'], $message));
            $author = $this->getPostAuthor($post);
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
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function delete($post) {
        try {
            $result = self::run("DELETE FROM posts WHERE id = ?", array($post));
            return array("status" => "deleted");
        } catch (SqlException $exception) {
            Snackbar::sendSnack($exception->getMessage());
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

}