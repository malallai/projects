<?php

namespace App\User;

use Core\Sql;
use \PDO;
use Exceptions\SqlException;
use Core\Snackbar;
class UserSql extends Sql {

    public function auth($username, $pwd) {
        $username = htmlspecialchars($username);
        $pwd = hash("whirlpool", $pwd);
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

    public function register($username, $mail, $pwd, $first, $last) {
        $username = htmlspecialchars($username);
        $mail = htmlspecialchars($mail);
        $first = htmlspecialchars($first);
        $last = htmlspecialchars($last);
        $pwd = hash("whirlpool", $pwd);
        $confirm_key = bin2hex(random_bytes(32));
        try {
            self::init_db();
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        try {
            $result = self::prepare("SELECT id FROM users WHERE username = ? OR email = ?", array($username, $mail));
            if (isset($result) && !empty($result)) {
                Snackbar::send_snack("Email or username already taken. ");
                return false;
            }
            $result = self::prepare("INSERT INTO users (username, first_name, last_name, email, password, conf_token) VALUES (?,?,?,?,?,?)", array($username, $first, $last, $mail, $pwd, $confirm_key));
            Snackbar::send_snack("Account successfuly created.");
            Snackbar::send_snack("Please confirm your account. Don't forget to checks spams.");
            return true;
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

    public function check_pwd($pwd) {
        $upper = preg_match('#[A-Z]#', $pwd);
        $lower = preg_match('#[a-z]#', $pwd);
        $nbr = preg_match('#[\d]#', $pwd);
        $special = preg_match('#[^a-zA-Z\d]#', $pwd);
        $len = strlen($pwd);
        return ($upper >= 1 && $lower >= 1 && $nbr >= 1 && $special >= 1 && $len >= 8);
    }

}