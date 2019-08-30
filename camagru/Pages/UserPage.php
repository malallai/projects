<?php

namespace Pages;
use App\User\UserController;
use Core\Page;
use Core\Session;
use Core\Snackbar;

class UserPage extends Page {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = UserController::get($this);
    }

    public function getController() {
        return $this->_controller;
    }

    public function index() {
        if (!$this->getController()->isLogged()) {
            $params = array('content' => 'user/User');
            $this->render($params);
        } else {
            Page::redirect("/");
        }
    }

    public function askPasswordReset() {
        if ($this->checkToken($_POST)) {
            if ($this->checkPostValues($_POST, "reset", "mail")) {
                $result = $this->getController()->askReset($_POST['mail']);
                Page::redirect("/user", $result['message']);
            }
        }
        Page::redirect("/user");
    }

    public function confirm() {
        $result = $this->getController()->confirmAccount($this->_url);
        Page::redirect("/user", $result['message']);
    }

    public function edit() {
        if ($this->getController()->isLogged()) {
            if ($this->checkPostValues($_POST, "update", "type")) {
                $this->editProfile($_POST);
            } else {
                $params = array('content' => 'user/Edit', 'user' => $this->getController()->getUserById($this->getController()->getSessionId()));
                $this->render($params);
            }
        } else {
            Page::redirect("/user", "Merci de vous connecter.");
        }
    }

    public function editProfile($post) {
        if ($this->getController()->isLogged()) {
            if ($this->checkToken($post)) {
                if ($this->checkPostValues($post, "type")) {
                    if ($post['type'] === "global") {
                        if ($this->checkPostValues($post, "old_username", "password", "username", "first_name", "last_name", "mail", "notifications")) {
                            $result = $this->getController()->editGlobalProfile($post['old_username'], $post['username'], $post['mail'], $post['first_name'], $post['last_name'], $post['notifications'], $post['password']);
                            Page::redirect("/user/edit", $result['message']);
                        }
                    } else if ($post['type'] === "password") {
                        if ($this->checkPostValues($post, "username", "password", "new_password", "repeat")) {
                            $result = $this->getController()->editPasswordProfile($post['username'], $post['password'], $post['new_password'], $post['repeat']);
                            Page::redirect("/user/edit", $result['message']);
                        }
                    }
                }
            }
            Page::redirect("/user/edit");
        } else Page::redirect("/user", "Merci de vous connecter.");
    }

    public function login() {
        if (!$this->getController()->isLogged()) {
            if ($this->checkToken($_POST)) {
                if ($this->checkPostValues($_POST, "login")) {
                    if (($result = $this->getController()->auth($_POST['username'], $_POST['password']))['status'] === true) {
                        Page::redirect("/", $result['message']);
                    } else Page::redirect("/user", $result['message']);
                }
            }
        } else Page::redirect("/");
        Page::redirect("/user");
    }

    public function logout($ask = true, $redirect = true) {
        if ($this->getController()->isLogged()) {
            Session::resetSession();
            if ($ask) Snackbar::sendSnack("Vous avez été déconnécté avec succès.");
        }
        if ($redirect) Page::redirect("/");
    }

    public function register() {
        if (!$this->getController()->isLogged()) {
            if ($this->checkToken($_POST)) {
                if ($this->checkPostValues($_POST, "register", "password", "repeat", "username", "mail")) {
                   $result = $this->getController()->register($_POST['username'], $_POST['mail'], $_POST['first_name'], $_POST['last_name'], $_POST['password'], $_POST['repeat']);
                   Page::redirect("/user", $result['message']);
                }
            }
        }
        Page::redirect("/user");
    }

    public function resetPassword() {
        if (!$this->getController()->isLogged()) {
            if ($this->checkToken($_POST)) {
                if ($this->checkPostValues($_POST, "password", "repeat", "reset_token")) {
                    $result = $this->getController()->resetPassword($_POST['password'], $_POST['repeat'], $_POST['reset_token']);
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
        if ($this->getController()->isLogged()) {
            $details = $this->getController()->getUserById($this->getController()->getSessionId());
            $posts = $this->getController()->getPostController()->getUserPosts($this->getController()->getSessionId());
            $params = array('content' => 'aside/Profile', 'details' => $details, 'posts' => $posts);
        } else {
            $params = array('content' => 'aside/Login');
        }
        $quick_content = $this->quickRender($params);
        return $quick_content;
    }

}