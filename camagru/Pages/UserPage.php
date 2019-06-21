<?php

namespace Pages;
use App\User\UserController;
use Core\Page;
use Core\Snackbar;
use App\User\UserStatus;

class UserPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
        $this->_controller = new UserController();
    }

    public function index() {
        if ($this->_controller->isLogged()) {
            $params = array('content' => 'user/User');
            $this->render($params);
        } else {
            $this->redirect("/profile");
        }
    }

    public function login() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['login']) && !empty($_POST['login'])) {
            if (isset($_POST['token']) && $this->_controller->getSql()->compareTokens($_POST['token'])) {
                if ($this->_controller->getSql()->auth($_POST['username'], $_POST['password'])) {
                    $_SESSION['user'] = serialize(array("username" => $_POST['username'], "status" => UserStatus::connected));
                    Snackbar::send_snack("Connection successful.");
                    $this->redirect("/profile");
                }
            }
        }

        $this->redirect("/user");
    }

    public function register() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['register']) && !empty($_POST['register'])) {
            if (isset($_POST['token']) && $this->_controller->getSql()->compareTokens($_POST['token'])) {
                if ($_POST['password'] === $_POST['password_repeat']) {
                    if ($this->_controller->getSql()->check_pwd($_POST['password'])) {
                        $this->_controller->getSql()->register($_POST['username'], $_POST['mail'], $_POST['password'], $_POST['first_name'], $_POST['last_name']);
                        $this->redirect("/user");
                    } else {
                        Snackbar::send_snack("Votre mot de passe n'est pas suffisamment sécurisé!");
                        Snackbar::send_snack("Veuillez mettre au moins : 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
                    }
                } else {
                    Snackbar::send_snack("Les mots de passes ne sont pas identique.");
                }
            }
        }
        $this->redirect("/user");
    }

    public function confirm() {
        if ($this->_controller->getSql()->confirm($this->_url)) {
            Snackbar::send_snack("Compte confirmé avec succes.");
            Snackbar::send_snack("Vous pouvez désormais vous connecter.");
        } else {
            Snackbar::send_snack("Token de confirmation inconnue.");
        }
        $this->redirect("/user");
    }

    public function reset_ask() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['reset']) && !empty($_POST['reset'])) {
            if (isset($_POST['token']) && $this->_controller->getSql()->compareTokens($_POST['token'])) {
                $this->_controller->getSql()->send_reset($_POST['mail']);
                Snackbar::send_snack("L'email à été envoyé si l'adresse indiqué existe dans notre base de donnée.");
                Snackbar::send_snack("Vérifiez vos spam.");
                $this->redirect("/user");
            }
        }
    }

    public function resetpw() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['reset']) && !empty($_POST['reset'])) {
            if (isset($_POST['token']) && $this->_controller->getSql()->compareTokens($_POST['token'])) {
                if ($_POST['password'] === $_POST['password_repeat']) {
                    if ($this->_controller->getSql()->check_pwd($_POST['password'])) {
                        if ($this->_controller->getSql()->edit_pwd($_POST['password'], $_POST['reset_token'])) {
                            Snackbar::send_snack("Votre mot de passe à été modifié.");
                            Snackbar::send_snack("Vous pouvez vous connecter.");
                        } else {
                            Snackbar::send_snack("Une erreur est survenue.");
                            $this->redirect("/user/resetpw/".$_POST['reset_token']);
                        }
                    } else {
                        Snackbar::send_snack("Votre mot de passe n'est pas suffisamment sécurisé!");
                        Snackbar::send_snack("Veuillez mettre au moins : 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
                        $this->redirect("/user/resetpw/".$_POST['reset_token']);
                    }
                } else {
                    Snackbar::send_snack("Les mots de passes ne sont pas identique.");
                    $this->redirect("/user/resetpw/".$_POST['reset_token']);
                }
                $this->redirect("/user");
            }
        }
        $this->redirect("/user");
    }

    public function resetpw_edit() {
        $params = array('content' => 'user/PwdReset');
        $this->render($params);
    }

    public function logout() {

    }

}