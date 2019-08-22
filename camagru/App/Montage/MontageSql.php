<?php

namespace App\Montage;

use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class MontageSql extends Sql {

    public function upload_picture($user_id, $picture_path) {
        try {
            $file = '/Public/assets/pictures/posts/'.$picture_path.'.jpeg';
            self::run("INSERT INTO posts (user_id, image_path) VALUES (?,?)", array($user_id, $file));
            return true;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

}