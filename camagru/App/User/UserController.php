<?php


namespace App\User;
use Core\Controller;
use Core\Mail;
use Core\Page;
use Core\Security;
use Core\Session;
use Core\Snackbar;

class UserController extends Controller {

    /**
     * @return UserSql
     */
    public function getSql() {
        return $this->_sql;
    }

    public function __construct($page) {
        $this->_sql = new UserSql();
        $this->_page = $page;
    }

    /**
     * @return Page
     */
    public function getPage() {
        return $this->_page;
    }

    public function isLogged() {
        Session::startSession();
        if (isset($_SESSION) && isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            if ($user['status'] === UserStatus::connected) return true;
        }
        return false;
    }

    public function isConfirmed($id) {
        return $this->getSql()->checkConfirmation($id);
    }

    public function getUserById($id) {
        $result = $this->getSql()->getUserById($id);
        return $result['result'];
    }

    public function getUserByUsername($username) {
        $result = $this->getSql()->getUserByUsername($username);
        return $result['result'];
    }

    public function getSessionId() {
        if ($this->isLogged())
            return $this->getSessionUser()['id'];
        return null;
    }

    public function getSessionUser() {
        if ($this->isLogged())
            return unserialize($_SESSION['user']);
        return null;
    }

    public function getLastUsers() {
        return $this->getSql()->getLastUsers(5)['result'];
    }

    public function getUserHomeDetails($userId) {
        return $this->getSql()->getUserHomeDetails($userId)['result'];
    }

    public function auth($username, $pwd) {
        $username = Security::convertHtmlEntities($username);
        Snackbar::sendSnack($pwd);
        $pwd = hash("whirlpool", Security::convertHtmlEntities($pwd));
        Snackbar::sendSnack($pwd);
        $id = $this->getUserByUsername($username)['id'];
        Snackbar::sendSnacks($id, $username);
        if ($id === null) {
            return array("status" => false, "message" => "Erreur lors de l'authentification.");
        }
        if (!$this->getSql()->checkPasswords($id, $pwd)) {
            return array("status" => false, "message" => "Le mot de passe est incorrect. Blbl");
        }
        if (!$this->getSql()->checkConfirmation($id)) {
            return array("status" => false, "message" => "Merci de confirmer votres mot compte avant de continuer.");
        }
        $_SESSION['user'] = serialize(array("id" => $id, "username" => $username, "status" => UserStatus::connected));
        return array("status" => true, "message" => "Authentification réussi.");
    }

    public function register($username, $mail, $first_name, $last_name, $password, $repeat) {
        if ($password !== $repeat) {
            return array("status" => false, "message" => "Les mots de passes ne sont pas identique.");
        }
        if (!$this->getSql()->checkPwd($password)) {
            return array("status" => false, "message" => "Votre mot de passe doit contenir: 8 caractères dont 1 majuscule, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
        }
        $username = Security::convertHtmlEntities($username);
        $mail = Security::convertHtmlEntities($mail);
        $first = Security::convertHtmlEntities($first_name);
        $last = Security::convertHtmlEntities($last_name);
        $password = hash("whirlpool", Security::convertHtmlEntities($password));
        if ($this->getSql()->userExist($username, $mail)) {
            return array("status" => false, "message" => "L'utilisateur éxiste déjà.");
        }
        $confirmKey = Security::newToken(32);
        if ($this->getSql()->register($username, $mail, $password, $first, $last, $confirmKey)) {
            $link = "https://camagru.malallai.fr/user/confirm/".$confirmKey;
            Mail::newMail($mail, "Confirmation d'inscription",
                "Merci de t'être inscrit sur Camagru.".
                "</br>".
                "Afin de pouvoir te connecter, merci de confirmer ton inscription en cliquant <a href='$link'>ici</a>.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru.".
                "</br></br>".
                "<span style='color:#999'>Si le lien ne fonctionne pas voici le lien direct: $link</span>"
            );
            return array("status" => true, "message" => "Veuillez confirmer votre inscription par mail.");
        }
        else
            return array("status" => false, "message" => "Une erreur est survenue");
    }

    public function confirmAccount($url) {
        $token = Security::convertHtmlEntities(explode('/', $url)[2]);
        if ($this->getSql()->confirm($token)) {
            return array("status" => true, "message" => "Compte confirmé avec succès.");
        } else {
            return array("status" => false, "message" => "Une erreur est survenue, merci de vérifier le token de confirmation.");
        }
    }

    public function askReset($mail) {
        $mail = Security::convertHtmlEntities($mail);
        $token = Security::newToken(32);
        if ($this->getSql()->sendReset($mail, $token)) {
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
            return array("status" => true, "message" => "Un email vous à été envoyé.");
        } else {
            return array("status" => false, "message" => "Une erreur est survenue.");
        }
    }

    function resetPassword($password, $repeat, $resetToken) {
        if ($password !== $repeat) {
            return array("status" => false, "message" => "Les mots de passe ne sont pas identique.");
        }
        if ($this->getSql()->checkPwd($password)) {
            return array("status" => false, "message" => "Votre mot de passe doit contenir: 8 caractères dont 1 majuscule, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
        }
        $password = hash("whirlpool", Security::convertHtmlEntities($password));
        $resetToken = Security::convertHtmlEntities($resetToken);
        $user = $this->getSql()->getResetUserId($resetToken);
        if ($this->getSql()->editPassword($password, 0, $resetToken)) {
            Mail::newMail($this->getUserById($user)['email'], "Changement de mot de passe",
                "Ton mot de passe viens d'être modifié.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru."
            );
            return array("status" => true, "message" => "Votre mot de passe à été modifié.");
        } else {
            return array("status" => true, "message" => "Une erreur est survenue.", "redirect" => "/user/resetpassword/".$resetToken);
        }
    }

    public function editGlobalProfile($oldUsername, $username, $mail, $firstName, $lastName, $notifications, $password) {
        $oldUsername = Security::convertHtmlEntities($oldUsername);
        $id = $this->getUserByUsername($oldUsername)['id'];
        $username = Security::convertHtmlEntities($username);
        $mail = Security::convertHtmlEntities($mail);
        $firstName = Security::convertHtmlEntities($firstName);
        $lastName = Security::convertHtmlEntities($lastName);
        $notifications = Security::convertHtmlEntities($notifications);
        $password = hash("whirlpool", Security::convertHtmlEntities($password));
        if (!$this->getSql()->checkPasswords($id, $password)) {
            return array("status" => false, "message" => "Mauvais mot de passe");
        }
        if ($this->getSql()->editProfile($id, $username, $firstName, $lastName, $mail, ($notifications === "true" ? 1 : 0))) {
            Session::resetSession();
            if (($auth = $this->auth($username, $password))) {
                Mail::newMail($mail, "Edition du profile",
                    "Votres profile viens d'être modifié.".
                    "</br></br>".
                    "Merci de ta confiance et à bientôt sur Camagru."
                );
                return array("status" => true, "message" => "Compte modifié avec succès.");
            } else {
                return $auth;
            }
        } else {
            return array("status" => false, "message" => "Une erreur est survenue.");
        }
    }

    public function editPasswordProfile($username, $password, $newPassword, $repeatPassword) {
        $username = Security::convertHtmlEntities($username);
        $id = $this->getUserByUsername($username)['id'];
        $password = hash("whirlpool", Security::convertHtmlEntities($password));
        if (!$this->getSql()->checkPasswords($id, $password)) {
            return array("status" => false, "message" => "Mauvais mot de passe");
        }
        if ($newPassword !== $repeatPassword) {
            return array("status" => false, "message" => "Les mots de passes ne sont pas identiques.");
        }
        if (!$this->getSql()->checkPwd($newPassword)) {
            return array("status" => false, "message" => "Votre mot de passe doit contenir: 8 caractères dont 1 majuscule, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
        }
        $newPassword = hash("whirlpool", Security::convertHtmlEntities($password));
        if ($this->getSql()->editPassword($newPassword, $id)) {
            Mail::newMail($this->getUserById($id)['email'], "Edition du profile",
                "Votres profile viens d'être modifié.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru."
            );
            return array("status" => true, "message" => "Mot de passe modifié.");
        } else {
            return array("status" => false, "message" => "Une erreur est survenue.");
        }
    }
}