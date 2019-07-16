<?php


namespace App\User;
use Core\Controller;
use Core\Session;
use Core\Snackbar;
use Exceptions\SqlException;

class UserController extends Controller {

    public function __construct() {
        $this->_sql = new UserSql();
    }

    public function isLogged() {
        Session::startSession();
        if (isset($_SESSION) && isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            if ($user['status'] === UserStatus::connected) return true;
        }
        return false;
    }

    public function get_user() {
        if ($this->isLogged()) {
            return unserialize($_SESSION['user']);
        } else {
            return null;
        }
    }
}