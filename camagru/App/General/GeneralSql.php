<?php


namespace App\General;
use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class GeneralSql extends Sql {

    //$this->_controller->getSql()->prepare("SELECT posts.*, users.username, (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = ?");

    public function getPosts($page = 1) {
        try {
            $postsPerPage = 5;
            $posts = $this->run("SELECT id FROM posts", array());
            $postsCount = $posts["statement"]->rowCount();
            $tot = ceil($postsCount / $postsPerPage);
            if(!($page > 0 AND $page <= $tot))
                return false;
            $start = ($page - 1) * $postsPerPage;
            $str = "SELECT * FROM posts ORDER BY id DESC LIMIT ".$start.",".$postsPerPage;
            $request = $this->run($str);
            var_dump($request["result"]);
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

}