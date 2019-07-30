<?php

namespace Pages;
use App\General\GeneralController;
use App\User\UserController;
use Core\Page;
use Core\Session;
use Core\Snackbar;
use App\User\UserStatus;

class UserPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new UserController();
    }

    public function index() {
        if (!$this->_controller->isLogged()) {
            $params = array('content' => 'user/User');
            $this->render($params);
        } else {
            $this->redirect("/");
        }
    }

    public function edit() {
        if ($this->_controller->isLogged()) {
            if (isset($_POST['token']) && isset($_POST['type']) && GeneralController::compareTokens($_POST['token'])) {
                return $this->editProfile($_POST);
            } else {
                $params = array('content' => 'user/Edit', 'user' => $this->_controller->getUserDetails()['result']);
                $this->render($params);
            }
        } else {
            $this->redirect("/user");
        }
    }

    public function login() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['login']) && !empty($_POST['login'])) {
            if (isset($_POST['token']) && GeneralController::compareTokens($_POST['token'])) {
                if ($this->_controller->getSql()->auth($_POST['username'], $_POST['password'])) {
                    $_SESSION['user'] = serialize(array("id" => $this->_controller->getUserId($_POST['username'], true), "username" => $_POST['username'], "status" => UserStatus::connected));
                    Snackbar::sendSnack("Connexion réussi.");
                    $this->redirect("/");
                }
            }
        }

        $this->redirect("/user");
    }

    public function register() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['register']) && !empty($_POST['register'])) {
            if (isset($_POST['token']) && GeneralController::compareTokens($_POST['token'])) {
                if ($_POST['password'] === $_POST['password_repeat']) {
                    if ($this->_controller->getSql()->checkPwd($_POST['password'])) {
                        $this->_controller->getSql()->register($_POST['username'], $_POST['mail'], $_POST['password'], $_POST['first_name'], $_POST['last_name']);
                        $this->redirect("/user");
                    } else {
                        Snackbar::sendSnack("Votre mot de passe n'est pas suffisamment sécurisé!");
                        Snackbar::sendSnack("8 caractères dont 1 majuscule, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
                    }
                } else {
                    Snackbar::sendSnack("Les mots de passes ne sont pas identique.");
                }
            }
        }
        $this->redirect("/user");
    }

    public function confirm() {
        if ($this->_controller->getSql()->confirm($this->_url)) {
            Snackbar::sendSnack("Compte confirmé avec succes.");
            Snackbar::sendSnack("Vous pouvez désormais vous connecter.");
        } else {
            Snackbar::sendSnack("Token de confirmation inconnue.");
        }
        $this->redirect("/user");
    }

    public function resetAsk() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['reset']) && !empty($_POST['reset'])) {
            if (isset($_POST['token']) && GeneralController::compareTokens($_POST['token'])) {
                $this->_controller->getSql()->sendReset($_POST['mail']);
                Snackbar::sendSnack("Un email vous a été envoyé sur l'adresse indiqué est correct.");
                Snackbar::sendSnack("Vérifiez vos spam.");
                $this->redirect("/user");
            }
        }
    }

    public function resetpw() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['reset']) && !empty($_POST['reset'])) {
            if (isset($_POST['token']) && GeneralController::compareTokens($_POST['token'])) {
                if ($_POST['password'] === $_POST['password_repeat']) {
                    if ($this->_controller->getSql()->checkPwd($_POST['password'])) {
                        if ($this->_controller->getSql()->editPwd($_POST['password'], 0, $_POST['reset_token'])) {
                            Snackbar::sendSnack("Votre mot de passe à été modifié.");
                            Snackbar::sendSnack("Vous pouvez vous connecter.");
                        } else {
                            Snackbar::sendSnack("Une erreur est survenue.");
                            $this->redirect("/user/resetpw/".$_POST['reset_token']);
                        }
                    } else {
                        Snackbar::sendSnack("Votre mot de passe n'est pas suffisamment sécurisé!");
                        Snackbar::sendSnack("8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
                        $this->redirect("/user/resetpw/".$_POST['reset_token']);
                    }
                } else {
                    Snackbar::sendSnack("Les mots de passes ne sont pas identique.");
                    $this->redirect("/user/resetpw/".$_POST['reset_token']);
                }
                $this->redirect("/user");
            }
        }
        $this->redirect("/user");
    }

    public function resetPwdEdit() {
        $params = array('content' => 'user/PwdReset');
        $this->render($params);
    }

    public function logout($ask = true, $redirect = true) {
        if ($this->_controller->isLogged()) {
            Session::resetSession();
            if ($ask) Snackbar::sendSnack("Vous avez été déconnécté avec succès.");
        }
        if ($redirect) $this->redirect("/");
    }

    public function profile() {
        $params = array();
        if ($this->_controller->isLogged()) {
            $details = $this->_controller->getSql()->getUser($this->_controller->getSessionId());
            $params = array('content' => 'aside/Profile', 'details' => $details);
        } else {
            $params = array('content' => 'aside/Login');
        }
        $quick_content = $this->quickRender($params);
        return $quick_content;
    }

    protected function checkPost($args) {
        if (isset($args['type']) && $args['type'] === "global") {
            if (!isset($args['first_name']) || !isset($args['last_name']) || !isset($args['username']) || !isset($args['old_username']) || !isset($args['password']) || !isset($args['mail']))
                return false;
            return true;
        } else if (isset($args['type']) && $args['type'] === "password") {
            if (!isset($args['password']) || !isset($args['new_password']) || !isset($args['repeat']) || !isset($args['username']))
                return false;
            return true;
        }
        return false;
    }

    public function editProfile($args) {
        Session::startSession();
        if (!$this->checkPost($args)) {
            $this->redirect("/user/edit");
        }
        if ($args['type'] === "global") {
            if ($this->_controller->getSql()->tryPass($args['old_username'], $args['password'])) {
                if (($request = $this->_controller->getSql()->editProfile($this->_controller->getSessionId(), $args['username'], $args['first_name'], $args['last_name'], $args['mail']))) {
                    $this->logout(false, false);
                    if ($this->_controller->getSql()->auth($args['username'], $args['password'])) {
                        $_SESSION['user'] = serialize(array("id" => $this->_controller->getUserId($args['username'], true), "username" => $args['username'], "status" => UserStatus::connected));
                    }
                    Snackbar::sendSnack("Profile édité avec succès.");
                } else {
                    Snackbar::sendSnack("Une erreur est survenue.");
                }
            } else {
                Snackbar::sendSnack("Mauvais mot de passe");
            }
        } else if ($args['type'] === "password") {
            if ($this->_controller->getSql()->tryPass($args['username'], $args['password'])) {
                if ($args['new_password'] === $args['repeat']) {
                    if ($this->_controller->getSql()->checkPwd($_POST['new_password'])) {
                        if ($this->_controller->getSql()->editPwd($_POST['new_password'], $this->_controller->getSessionId())) {
                            Snackbar::sendSnack("Votre mot de passe à été modifié.");
                        } else {
                            Snackbar::sendSnack("Une erreur est survenue.");
                        }
                    } else {
                        Snackbar::sendSnack("Votre mot de passe n'est pas suffisamment sécurisé!");
                        Snackbar::sendSnack("8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
                    }
                } else {
                    Snackbar::sendSnack("Les mots de passes ne sont pas identique.");
                }
            } else {
                Snackbar::sendSnack("Mauvais mot de passe");
            }
        }

        $this->redirect("/user/edit");
    }

}