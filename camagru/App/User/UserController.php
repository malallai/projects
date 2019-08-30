<?php


namespace App\User;
use App\Post\PostController;
use App\Setup\SetupController;
use Core\Controller;
use Core\Mail;
use Core\Security;
use Core\Session;

class UserController extends Controller {

    protected static $_instance = null;
    private $_postController;

    public function getSql() {
        return $this->_sql;
    }

    public function __construct($page) {
        if (self::$_instance === null) {
            self::$_instance = $this;
            $this->_sql = new UserSql();
            $this->_page = $page;
            $this->_postController = PostController::get($page);
        }
    }

    public static function get($page) {
        if (self::$_instance === null)
            return new UserController($page);
        return self::$_instance;
    }

    public function getPostController() {
        return $this->_postController;
    }

    public function getPage() {
        return $this->_page;
    }

    public function isLogged() {
        Session::startSession();
        if (isset($_SESSION) && isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            return true;
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
        Session::startSession();
        $username = Security::convertChars($username);
        $pwd = hash("whirlpool", Security::convertPassword($pwd));
        $id = $this->getUserByUsername($username)['id'];
        if ($id === null) {
            return array("status" => false, "message" => "Erreur lors de l'authentification.");
        }
        if (!$this->getSql()->checkPasswords($id, $pwd)) {
            return array("status" => false, "message" => "Le mot de passe est incorrect.");
        }
        if (!$this->getSql()->checkConfirmation($id)) {
            return array("status" => false, "message" => "Merci de confirmer votres mot compte avant de continuer.");
        }
        $_SESSION['user'] = serialize(array("id" => $id, "username" => $username));
        return array("status" => true, "message" => "Authentification réussi.");
    }

    public function register($username, $mail, $first_name, $last_name, $password, $repeat) {
        if ($password !== $repeat) {
            return array("status" => false, "message" => "Les mots de passes ne sont pas identique.");
        }
        if (!$this->checkPwd($password)) {
            return array("status" => false, "message" => "Votre mot de passe doit contenir: 8 caractères dont 1 majuscule, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
        }
        $username = Security::convertChars($username);
        $mail = Security::convertChars($mail);
        $first = Security::convertChars($first_name);
        $last = Security::convertChars($last_name);
        $password = hash("whirlpool", Security::convertPassword($password));
        if ($this->getSql()->userExist($username, $mail)) {
            return array("status" => false, "message" => "L'utilisateur éxiste déjà.");
        }
        $confirmKey = Security::newToken(32);
        if ($this->getSql()->register($username, $mail, $password, $first, $last, $confirmKey)) {
            $link = Security::getHost()."/user/confirm/".$confirmKey;
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
        $token = Security::convertChars(explode('/', $url)[2]);
        if ($this->getSql()->confirm($token)) {
            return array("status" => true, "message" => "Compte confirmé avec succès.");
        } else {
            return array("status" => false, "message" => "Une erreur est survenue, merci de vérifier le token de confirmation.");
        }
    }

    public function askReset($mail) {
        $mail = Security::convertChars($mail);
        $token = Security::newToken(32);
        if ($this->getSql()->sendReset($mail, $token)) {
            $link = Security::getHost()."/user/reset_password/".$token;
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

    public function checkPwd($pwd) {
        $upper = preg_match('#[A-Z]#', $pwd);
        $lower = preg_match('#[a-z]#', $pwd);
        $nbr = preg_match('#[\d]#', $pwd);
        $special = preg_match('#[^a-zA-Z\d]#', $pwd);
        $len = strlen($pwd);
        return ($upper >= 1 && $lower >= 1 && $nbr >= 1 && $special >= 1 && $len >= 8);
    }

    function resetPassword($password, $repeat, $resetToken) {
        $password = Security::convertPassword($password);
        $repeat = Security::convertPassword($repeat);
        if ($password !== $repeat) {
            return array("status" => false, "message" => "Les mots de passe ne sont pas identique.", "redirect" => "/user/reset_password/".$resetToken);
        }
        if (!$this->checkPwd($password)) {
            return array("status" => false, "message" => "Votre mot de passe doit contenir: 8 caractères dont 1 majuscule, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.", "redirect" => "/user/reset_password/".$resetToken);
        }
        $password = hash("whirlpool", $password);
        $resetToken = Security::convertChars($resetToken);
        $user = $this->getSql()->getResetUserId($resetToken);
        if ($this->getSql()->editPassword($password, 0, $resetToken)) {
            Mail::newMail($this->getUserById($user)['email'], "Changement de mot de passe",
                "Ton mot de passe viens d'être modifié.".
                "</br></br>".
                "Merci de ta confiance et à bientôt sur Camagru."
            );
            return array("status" => true, "message" => "Votre mot de passe à été modifié.");
        } else {
            return array("status" => true, "message" => "Une erreur est survenue.", "redirect" => "/user/reset_password/".$resetToken);
        }
    }

    public function editGlobalProfile($oldUsername, $username, $mail, $firstName, $lastName, $notifications, $password) {
        $oldUsername = Security::convertChars($oldUsername);
        $id = $this->getUserByUsername($oldUsername)['id'];
        $username = Security::convertChars($username);
        $mail = Security::convertChars($mail);
        $firstName = Security::convertChars($firstName);
        $lastName = Security::convertChars($lastName);
        $notifications = Security::convertChars($notifications);
        $tmpPassword = $password;
        $password = hash("whirlpool", Security::convertPassword($password));
        if (!$this->getSql()->checkPasswords($id, $password)) {
            return array("status" => false, "message" => "Mauvais mot de passe");
        }
        if ($this->getSql()->editProfile($id, $username, $firstName, $lastName, $mail, ($notifications === "true" ? 1 : 0))) {
            Session::resetSession();
            if (($auth = $this->auth($username, $tmpPassword))) {
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
        $username = Security::convertChars($username);
        $id = $this->getUserByUsername($username)['id'];
        $password = hash("whirlpool", Security::convertPassword($password));
        if (!$this->getSql()->checkPasswords($id, $password)) {
            return array("status" => false, "message" => "Mauvais mot de passe");
        }
        if ($newPassword !== $repeatPassword) {
            return array("status" => false, "message" => "Les mots de passes ne sont pas identiques.");
        }
        if (!$this->checkPwd($newPassword)) {
            return array("status" => false, "message" => "Votre mot de passe doit contenir: 8 caractères dont 1 majuscule, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
        }
        $newPassword = hash("whirlpool", Security::convertPassword($password));
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