<?php

namespace App\User;

use Core\Sql;
use Exceptions\SqlException;
use Core\Snackbar;
use PDO;

class UserSql extends Sql {

    public function checkConfirmation($id) {
        try {
            $result = self::run("SELECT confirmed FROM users WHERE id = ?", array($id))["result"];
            if (isset($result) && !empty($result)) {
                if ($result['confirmed'] == 0)
                    return false;
            }
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return true;
    }

    public function checkPasswords($id, $pwd) {
        try {
            $result = self::run("SELECT password FROM users WHERE id = ?", array($id))["result"];
            if (isset($result) && !empty($result)) {
                if ($result['password'] === $pwd)
                    return true;
            }
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return false;
    }

    public function userExist($username, $mail) {
        try {
            $result = self::run("SELECT id FROM users WHERE username = ? OR email = ?", array($username, $mail))["result"];
            if (isset($result) && !empty($result)) {
                return true;
            }
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return false;
    }

    public function getResetUserId($resetToken) {
        try {
            if ($resetToken !== null) {
                $result = self::run("SELECT user_id FROM pwd_reset WHERE token = ?", array($resetToken))["result"];
                if (!isset($result) || empty($result)) {
                    return false;
                }
                $id = $result['user_id'];
                return $id;
            }
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return false;
    }

    public function register($username, $mail, $pwd, $first, $last, $confirmKey) {
        try {
            self::run("INSERT INTO users (username, first_name, last_name, email, password, conf_token) VALUES (?,?,?,?,?,?)", array($username, $first, $last, $mail, $pwd, $confirmKey));
            return true;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function confirm($token) {
        try {
            $result = self::run("SELECT id FROM users WHERE conf_token = ?", array($token))["result"];
            if (!isset($result) || empty($result)) {
                return false;
            }
            $uid = $result['id'];
            self::run("UPDATE users SET confirmed = 1, conf_token = NULL WHERE id = ?", array($uid));
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return true;
    }

    public function sendReset($mail, $resetToken) {
        try {
            $result = self::run("SELECT id FROM users WHERE email = ?", array($mail))["result"];
            if (!isset($result) || empty($result)) {
                return false;
            }
            self::run("INSERT INTO pwd_reset (user_id, token) VALUES (?,?)", array($result['id'], $resetToken));
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return true;
    }

    public function editPassword($password, $id, $token = null) {
        try {
            if ($token !== null) {
                $id = $this->getResetUserId($token);
                if ($id)
                    self::run("DELETE FROM pwd_reset WHERE token LIKE ? ESCAPE '#'", array($token));
            }
            $result = self::run("SELECT id, email FROM users WHERE id = ?", array($id))["result"];
            self::run("UPDATE users SET password = ? WHERE id = ?", array($password, $result['id']));
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return true;
    }

    public function editProfile($id, $username, $first, $last, $mail, $notifications) {
        try {
            $details = self::run("SELECT username, email FROM users WHERE id = ?", array($id))['result'];
            if ($username !== $details['username']) {
                $result = self::run("SELECT id FROM users WHERE username = ?", array($username))["result"];
                if (isset($result) && !empty($result)) {
                    Snackbar::sendSnack("Le nom d'utilisateur est déjà pris.");
                    return false;
                }
            }
            if ($mail !== $details['email']) {
                $result = self::run("SELECT id FROM users WHERE email = ?", array($mail))["result"];
                if (isset($result) && !empty($result)) {
                    Snackbar::sendSnack("L'email est déjà pris.");
                    return false;
                }
            }
            self::run("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, notifications = ? WHERE id = ?", array($first, $last, $mail, $username, $notifications, $id));
            return true;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public static function getUserById($id) {
        try {
            $request = self::run("SELECT * FROM users WHERE id = ?", array($id));
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return null;
        }
    }

    public function getUserByUsername($username) {
        try {
            $request = self::run("SELECT * FROM users WHERE username = ?", array($username));
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return null;
        }
    }

    public function getLastUsers($count) {
        try {
            $request = self::bindValueRunList("SELECT * FROM users ORDER BY id DESC LIMIT :offset, :fetch",  array("offset" => array(0, PDO::PARAM_INT), "fetch" => array($count, PDO::PARAM_INT)), PDO::FETCH_ASSOC);
            return $request;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getUserHomeDetails($userId) {
        try {
            $request = self::run("SELECT users.username, users.avatar, count(user_id) AS posts FROM users LEFT JOIN posts ON posts.user_id = users.id WHERE users.id = ?", array($userId));
            return $request;
        } catch (SqlException $exception) {
            Snackbar::sendSnack($exception->getMessage());
            return false;
        }
    }

}