<?php

namespace App\Montage;

use Core\Snackbar;
use Core\Sql;
use Exceptions\SqlException;

class MontageSql extends Sql {

    public function upload_picture($user_id, $picture_path) {
        try {
            self::init_db();
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        try {
            $result = self::prepare("SELECT password, confirmed FROM users WHERE username = ?", array($username));
            if (isset($result) && !empty($result)) {
                if ($result['password'] === $pwd) {
                    if ($result['confirmed'] == 0) {
                        Snackbar::send_snack("Please confirm your account before using it.");
                        return false;
                    }
                    return true;
                }
            }
            Snackbar::send_snack("Wrong username or password.");
            return false;
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

}