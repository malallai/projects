<?php


namespace App\User;
use Core\Controller;
use Core\Session;

class UserController extends Controller {

    public function __construct() {
        $this->_sql = new UserSql();
    }

    public function isLogged() {
        Session::startSession();
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            if ($user['status'] === UserStatus::connected) return true;
        }
        return false;
    }

}