<?php


namespace App\General;
use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class GeneralSql extends Sql {

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