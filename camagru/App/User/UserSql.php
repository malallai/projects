<?php

namespace App\User;

use Core\Sql;
use Exceptions\SqlException;
use Core\Snackbar;
use Core\Mail;
use PDO;

class UserSql extends Sql {

    public function auth($username, $pwd) {
        $username = htmlentities(htmlspecialchars($username));
        $pwd = hash("whirlpool", $pwd);
        try {
            $result = self::run("SELECT password, confirmed FROM users WHERE username = ?", array($username))["result"];
            if (isset($result) && !empty($result)) {
                if ($result['password'] === $pwd) {
                    if ($result['confirmed'] == 0) {
                        Snackbar::sendSnack("Please confirm your account before using it.");
                        return false;
                    }
                    return true;
                }
            }
            Snackbar::sendSnack("Wrong username or password.");
            return false;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function register($username, $mail, $pwd, $first, $last) {
        $username = htmlentities(htmlspecialchars($username));
        $mail = htmlentities(htmlspecialchars($mail));
        $first = htmlentities(htmlspecialchars($first));
        $last = htmlentities(htmlspecialchars($last));
        $pwd = hash("whirlpool", $pwd);
        $confirm_key = bin2hex(random_bytes(32));
        try {
            $result = self::run("SELECT id FROM users WHERE username = ? OR email = ?", array($username, $mail))["result"];
            if (isset($result) && !empty($result)) {
                Snackbar::sendSnack("Email or username already taken. ");
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
            Snackbar::sendSnack("Account successfuly created.");
            Snackbar::sendSnack("Please confirm your account. Don't forget to checks spams.");
            return true;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function checkPwd($pwd) {
        $upper = preg_match('#[A-Z]#', $pwd);
        $lower = preg_match('#[a-z]#', $pwd);
        $nbr = preg_match('#[\d]#', $pwd);
        $special = preg_match('#[^a-zA-Z\d]#', $pwd);
        $len = strlen($pwd);
        return ($upper >= 1 && $lower >= 1 && $nbr >= 1 && $special >= 1 && $len >= 8);
    }

    public function confirm($token) {
        $token = htmlentities(htmlspecialchars(explode('/', $token)[2]));
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

    public function sendReset($mail) {
        $mail = htmlentities(htmlspecialchars($mail));
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
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return true;
    }

    public function tryPass($username, $pwd) {
        $pwd = hash("whirlpool", $pwd);
        try {
            $result = self::run("SELECT password, confirmed FROM users WHERE username = ?", array($username))["result"];
            if (isset($result) && !empty($result)) {
                if ($result['password'] === $pwd) {
                    return true;
                }
            }
            return false;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function editPwd($password, $id, $token = null) {
        $password = hash('whirlpool', $password);
        try {
            if ($token !== null) {
                $result = self::run("SELECT user_id FROM pwd_reset WHERE token = ?", array($token))["result"];
                $id = $result['user_id'];
                if (!isset($result) || empty($result)) {
                    return false;
                }
                self::run("DELETE FROM pwd_reset WHERE token LIKE ? ESCAPE '#'", array($token));
            }
            $result = self::run("SELECT id, email FROM users WHERE id = ?", array($id))["result"];
            Mail::newMail($result['email'], "Changement de mot de passe",
                "Ton mot de passe viens d'être modifié.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru."
            );
            self::run("UPDATE users SET password = ? WHERE id = ?", array($password, $result['id']));
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        return true;
    }

    public function editProfile($id, $username, $first, $last, $mail) {
        $username = htmlentities(htmlspecialchars($username));
        $mail = htmlentities(htmlspecialchars($mail));
        $first = htmlentities(htmlspecialchars($first));
        $last = htmlentities(htmlspecialchars($last));
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
            self::run("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ? WHERE id = ?", array($first, $last, $mail, $username, $id));
            Mail::newMail($mail, "Édition du profile",
                "Votres profile viens d'être modifié.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru."
            );
            return true;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getUserId($username) {
        try {
            $result = self::run("SELECT id FROM users WHERE username = ?", array($username))["result"];
            if (!isset($result) || empty($result)) {
                return null;
            }
            return $result['id'];
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return null;
        }
    }

    public function getLastUsers() {
        try {
            $request = self::runList("SELECT * FROM users ORDER BY id DESC LIMIT 5",  array(), PDO::FETCH_ASSOC);
            return $request['result'];
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getUser($id) {
        try {
            $posts = self::runList("SELECT posts.*, (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS likes, (SELECT COUNT(*) FROM comments WHERE comments.post_id = posts.id) AS comments FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.id = ? ORDER BY date DESC",  array($id), PDO::FETCH_ASSOC);
            return array('posts' => $posts['result'], 'user' => $this->getUserDetails($id)['result']);
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
    }

    public function getUserDetails($id) {
        try {
            $user = self::run("SELECT users.username, users.first_name, users.last_name, users.email, users.notifications FROM users WHERE id = ?", array($id));
            return $user;
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }

    }

}