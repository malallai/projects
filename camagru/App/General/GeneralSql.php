<?php


namespace App\General;
use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class GeneralSql extends Sql {

    public function getPosts($page = 1) {
        try {
            self::init_db();
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        try {
            $postsPerPage = 5;
            $posts = $this->prepare("SELECT id FROM posts", array());
            $postsCount = $posts->rowCount();
            $tot = ceil($postsCount / $postsPerPage);
            if(!($page > 0 AND $page <= $tot))
                return false;
            $start = ($page - 1) * $postsPerPage;
            //$this->_controller->getSql()->prepare("SELECT posts.*, users.username, (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
            $result = $this->_controller->getSql()->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT ?,?", array($start, $postsPerPage));
            var_dump($result);
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

}