<?php

namespace App\Montage;

use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class MontageSql extends Sql {

    public function upload_picture($user_id, $picture_path) {
        try {
            $result = self::run("INSERT INTO posts (user_id, image_path, date) VALUES (?,?,CURTIME())", array($user_id, $picture_path));
            var_dump($result['statement']);
            var_dump($result['result']);
            Snackbar::send_snack("Picture send to DB");
            return true;
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

}