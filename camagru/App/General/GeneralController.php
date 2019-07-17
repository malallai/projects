<?php

namespace App\General;
use Core\Controller;
use App\User\UserController;

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

}