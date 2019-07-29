<?php

namespace App\Post;

use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

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
                return "unlike/".$this->getLikeCount($id);
            } else {
                self::run("INSERT INTO likes (post_id, user_id) VALUES(?, ?)", array($id, $user));
                return "like/".$this->getLikeCount($id);
            }
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

}