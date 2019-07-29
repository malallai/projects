<?php

namespace App\Post;

use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class PostSql extends Sql {

    public function postExist($id) {
        try {
            $result = self::run("SELECT COUNT(id) FROM posts WHERE id = ?", array($id));
            return ($result == 1 ? true : false);
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function like($id, $user) {
        try {
            self::run("INSERT INTO likes (post_id, user_id) VALUES(?, ?)", array($id, $user));
            return true;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

}