<?php

namespace App\User;

use Core\Sql;
use Exceptions\SqlException;
use Core\Snackbar;
use Core\Mail;
use PDO;

class UserSql extends Sql {

    public function auth($username, $pwd) {
        $username = htmlspecialchars($username);
        $pwd = hash("whirlpool", $pwd);
        try {
            $result = self::run("SELECT password, confirmed FROM users WHERE username = ?", array($username))["result"];
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
            $result = self::run("SELECT id FROM users WHERE username = ? OR email = ?", array($username, $mail))["result"];
            if (isset($result) && !empty($result)) {
                Snackbar::send_snack("Email or username already taken. ");
                return false;
            }
            $link = "https://camagru.malallai.fr/user/confirm/".$confirm_key;
            Mail::newMail($mail, "Confirmation d'inscription",
                "Merci de t'être inscrit sur Camagru.".
                "</br>".
                "Afin de pouvoir te connecter, merci de confirmer ton inscription en cliquant <a href='$link'>ici</a>.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru.".
                "</br></br>".
                "<span style='color:#999'>Si le lien ne fonctionne pas voici le lien direct: $link</span>"
            );
            self::run("INSERT INTO users (username, first_name, last_name, email, password, conf_token) VALUES (?,?,?,?,?,?)", array($username, $first, $last, $mail, $pwd, $confirm_key));
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

    public function confirm($token) {
        $token = htmlspecialchars(explode('/', $token)[2]);
        try {
            $result = self::run("SELECT id FROM users WHERE conf_token = ?", array($token))["result"];
            if (!isset($result) || empty($result)) {
                return false;
            }
            $uid = $result['id'];
            self::run("UPDATE users SET confirmed = 1, conf_token = NULL WHERE id = ?", array($uid));
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        return true;
    }

    public function send_reset($mail) {
        $mail = htmlspecialchars($mail);
        $token = bin2hex(random_bytes(32));
        try {
            $result = self::run("SELECT id FROM users WHERE email = ?", array($mail))["result"];
            if (!isset($result) || empty($result)) {
                return false;
            }
            $link = "https://camagru.malallai.fr/user/resetpw/".$token;
            Mail::newMail($mail, "Changement de mot de passe",
                "Tu as fais une demande pour changer ton mot de passe.".
                "</br>".
                "Cliques <a href='$link'>ici</a> afin de procéder.".
                "</br></br>".
                "Si tu n'es pas à l'origine de cette demande, ignore ce mail.".
                "Merci de ta confiance et à bientôt sur Camagru.".
                "</br></br>".
                "<span style='color:#999'>Si le lien ne fonctionne pas voici le lien direct: $link</span>"
            );
            self::run("INSERT INTO pwd_reset (user_id, token) VALUES (?,?)", array($result['id'], $token));
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        return true;
    }

    public function edit_pwd($password, $token) {
        $password = hash('whirlpool', $password);
        try {
            $result = self::run("SELECT user_id FROM pwd_reset WHERE token = ?", array($token))["result"];
            if (!isset($result) || empty($result)) {
                return false;
            }
            $result = self::run("SELECT id, email FROM users WHERE id = ?", array($result['user_id']))["result"];
            $link = "https://camagru.malallai.fr/user/resetpw/".$token;
            Mail::newMail($result['email'], "Changement de mot de passe",
                "Ton mot de passe viens d'être modifié.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru."
            );
            self::run("UPDATE users SET password = ? WHERE id = ?", array($password, $result['id']));
            self::run("DELETE FROM pwd_reset WHERE token LIKE ? ESCAPE '#'", array($token));
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        return true;
    }

    public function get_user_id($username) {
        try {
            $result = self::run("SELECT id FROM users WHERE username = ?", array($username))["result"];
            if (!isset($result) || empty($result)) {
                return null;
            }
            return $result['id'];
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return null;
        }
    }

    public function getLastUsers() {
        try {
            $request = self::runList("SELECT * FROM users ORDER BY id DESC LIMIT 5",  array(), PDO::FETCH_ASSOC);
            return $request['result'];
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
    }

}