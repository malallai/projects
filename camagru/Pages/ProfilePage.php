<?php

namespace Pages;
use App\User\UserController;
use Core\Page;
use Core\Snackbar;

class ProfilePage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
        $this->_controller = new UserController();
    }

    public function index() {
        if ($this->_controller->isLogged()) {
            $params = array('content' => 'aside/Profile');
            $this->render($params);
        } else {
            Snackbar::send_snack("Connectez vous afin d'accéder à votre profile.");
            $this->redirect("user");
        }
    }

}