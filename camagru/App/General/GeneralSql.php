<?php


namespace App\General;
use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;
use PDO;

class GeneralSql extends Sql {

    //$this->_controller->getSql()->prepare("SELECT posts.*, users.username, (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = ?");

    public function getPosts($page = 1) {
        try {
            $postsPerPage = 5;
            $posts = self::run("SELECT id FROM posts", array());
            $postsCount = $posts["statement"]->rowCount();
            $tot = ceil($postsCount / $postsPerPage);
            if(!($page > 0 AND $page <= $tot))
                return false;
            $start = $postsCount - (($postsPerPage - 1) * $page);
            $end = $start + $postsPerPage;
            Snackbar::send_snack("Posts : ".$postsCount);
            Snackbar::send_snack("Start : ".$start);
            Snackbar::send_snack("End : ".$end);
            $request = self::runList("SELECT * FROM posts WHERE id BETWEEN ? AND ? ORDER BY id DESC",  array($start, $end), PDO::FETCH_ASSOC);
            Snackbar::send_snack($request['result']);
            return $request['result'];
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

    public function getPost($id) {
        try {
            $request = self::run("SELECT posts.*, users.username, (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = ?",  array($id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

    public function getUser($id) {
        try {
            $request = self::run("SELECT users.*, (SELECT COUNT(*) FROM posts WHERE posts.user_id = ?) AS posts FROM users WHERE users.id = ?",  array($id, $id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

}