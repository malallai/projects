<?php

namespace Pages;
use App\User\UserSql;
use Core\Page;
use Core\Snackbar;

class UserPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
        $this->_sql = new UserSql();
    }

    public function index() {
        $params = array('content' => 'user/User');
        $this->render($params);
    }

    public function login() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['login']) && !empty($_POST['login'])) {
            if (isset($_POST['token']) && $this->_sql->compareTokens($_POST['token'])) {
                if ($this->_sql->auth($_POST['username'], $_POST['password'])) {
                    $_SESSION['user'] = $_POST['username'];
                    Snackbar::send_snack("Connection successful.");
                    $this->redirect("/profile");
                }
            }
        }

        $this->redirect("/user");
    }

    public function register() {
        if (isset($_POST) && !empty($_POST) && isset($_POST['register']) && !empty($_POST['register'])) {
            if (isset($_POST['token']) && $this->_sql->compareTokens($_POST['token'])) {
                if ($_POST['password'] === $_POST['password_repeat']) {
                    if ($this->_sql->check_pwd($_POST['password'])) {
                        $this->_sql->register($_POST['username'], $_POST['mail'], $_POST['password'], $_POST['first_name'], $_POST['last_name']);
                        $this->redirect("/user");
                    } else {
                        Snackbar::send_snack("Votre mot de passe n'est pas suffisamment sécurisé!");
                        Snackbar::send_snack("Veuillez mettre au moins : 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.");
                    }
                } else {
                    Snackbar::send_snack("Les mots de passes ne sont pas identique.");
                }
            } else {
                Snackbar::send_snack("Bad token.");
            }
        } else {
            Snackbar::send_snack("Bad post request.");
        }
        $this->redirect("/user");
    }

}