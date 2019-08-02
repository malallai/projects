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
        $this->_controller = new UserController($this);
    }

    public function index() {
        if (!$this->_controller->isLogged()) {
            $params = array('content' => 'user/User');
            $this->render($params);
        } else {
            Page::redirect("/");
        }
    }

    public function askPasswordReset() {
        if ($this->checkToken($_POST)) {
            if ($this->checkPostValues($_POST, "reset", "mail")) {
                $result = $this->_controller->askReset($_POST['mail']);
                Page::redirect("/user", $result['message']);
            }
        }
        Page::redirect("/user");
    }

    public function confirm() {
        $result = $this->_controller->confirmAccount($this->_url);
        Page::redirect("/user", $result['message']);
    }

    public function edit() {
        if ($this->_controller->isLogged()) {
            if ($this->checkPostValues($_POST, "update", "type")) {
                $this->editProfile($_POST);
            } else {
                $params = array('content' => 'user/Edit', 'user' => $this->_controller->getUserDetails()['result']);
                $this->render($params);
            }
        } else {
            Page::redirect("/user", "Merci de vous connecter.");
        }
    }

    public function editProfile($post) {
        if (!$this->_controller->isLogged()) {
            if ($this->checkToken($post)) {
                if ($this->checkPostValues($post, "type")) {
                    if ($post['type'] === "global") {
                        if ($this->checkPostValues($post, "old_username", "password", "username", "first_name", "last_name", "mail", "notifications")) {
                            $result = $this->_controller->editGlobalProfile($post['old_username'], $post['username'], $post['mail'], $post['first_name'], $post['last_name'], $post['notifications'], $post['password']);
                            Page::redirect("/user/edit", $result['message']);
                        }
                    } else if ($post['type'] === "password") {
                        if ($this->checkPostValues($post, "username", "password", "new_password", "repeat")) {
                            $result = $this->_controller->editPasswordProfile($post['username'], $post['password'], $post['new_password'], $post['repeat']);
                            Page::redirect("/user/edit", $result['message']);
                        }
                    }
                }
            }
            Page::redirect("/user/edit");
        } else Page::redirect("/user", "Merci de vous connecter.");
    }

    public function login() {
        if (!$this->_controller->isLogged()) {
            if ($this->checkToken($_POST)) {
                if ($this->checkPostValues($_POST, "login")) {
                    if (($result = $this->_controller->auth($_POST['username'], $_POST['password']))['status'] === true) {
                        Page::redirect("/", $result['message']);
                    } else Page::redirect("/user", $result['message']);
                }
            }
        } else Page::redirect("/");
        Page::redirect("/user");
    }

    public function logout($ask = true, $redirect = true) {
        if ($this->_controller->isLogged()) {
            Session::resetSession();
            if ($ask) Snackbar::sendSnack("Vous avez été déconnécté avec succès.");
        }
        if ($redirect) Page::redirect("/");
    }

    public function register() {
        if (!$this->_controller->isLogged()) {
            if ($this->checkToken($_POST)) {
                if ($this->checkPostValues($_POST, "register", "password", "repeat", "username", "mail")) {
                   $result = $this->_controller->register($_POST['username'], $_POST['mail'], $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['repeat']);
                   Page::redirect("/user", $result['message']);
                }
            }
        }
        Page::redirect("/user");
    }

    public function resetPassword() {
        if (!$this->_controller->isLogged()) {
            if ($this->checkToken($_POST)) {
                if ($this->checkPostValues($_POST, "password", "repeat", "reset_token")) {
                    $result = $this->_controller->resetPassword($_POST['password'], $_POST['repeat'], $_POST['reset_token']);
                    Page::redirect(isset($result['redirect']) ? $result['redirect'] : "/user", $result['message']);
                }
            }
        }
        Page::redirect("/user");
    }

    public function editPassword() {
        $params = array('content' => 'user/PwdReset');
        $this->render($params);
    }

    public function profile() {
        $params = null;
        if ($this->_controller->isLogged()) {
            $details = $this->_controller->getUserById($this->_controller->getSessionId());
            $params = array('content' => 'aside/Profile', 'details' => $details);
        } else {
            $params = array('content' => 'aside/Login');
        }
        $quick_content = $this->quickRender($params);
        return $quick_content;
    }

}