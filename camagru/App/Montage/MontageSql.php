<?php

namespace App\Montage;

use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class MontageSql extends Sql {

    public function upload_picture($user_id, $picture_path) {
        date_default_timezone_set('UTC');
        try {
            self::init_db();
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        try {
            $result = self::prepare("INSERT INTO posts (user_id, image_path, date) VALUES (?,?,?)", array($user_id, $picture_path, date("dd-mm-YYYY HH:ii:ss")));
            Snackbar::send_snack("Picture send to DB");
            return true;
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

}