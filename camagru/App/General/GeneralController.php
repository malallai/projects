<?php

namespace App\General;
use Core\Controller;
use App\User\UserController;
use Core\Session;

class GeneralController extends Controller {
    private $_user_controller;

    public function __construct() {
        $this->_sql = new GeneralSql();
        $this->_user_controller = new UserController();
    }

    /**
     * @return UserController
     */
    public function getUserController() {
        return $this->_user_controller;
    }

    /**
     * @return GeneralSql
     */
    public function getSql() {
        return $this->_sql;
    }

    public static function compareTokens($token) {
        Session::startSession();
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            if ($_SESSION['token'] === $token) {
                return true;
            }
        }
        return false;
    }

}