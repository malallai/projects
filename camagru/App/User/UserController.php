<?php


namespace App\User;
use Core\Controller;
use Core\Page;
use Core\Session;
use Core\Snackbar;
use Exceptions\SqlException;
use PDO;

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

    public function getUserId($username, $force = false) {
        if ($this->isLogged() || $force) {
            return $this->getSql()->getUserId($username);
        } else {
            return null;
        }
    }

    public function getSessionId() {
        if ($this->isLogged())
            return $this->getUser()['id'];
        return false;
    }

    public function getUser() {
        if ($this->isLogged()) {
            return unserialize($_SESSION['user']);
        } else {
            return null;
        }
    }

    public function getUserDetails() {
        if ($this->isLogged()) {
            return $this->getSql()->getUserDetails($this->getSessionId());
        } else return null;
    }

    public function getLastUsers() {
        return $this->getSql()->getLastUsers(5)['result'];
    }
}