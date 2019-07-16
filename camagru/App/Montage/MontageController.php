<?php

namespace App\Montage;

use App\User\UserController;
use Core\Controller;

class MontageController extends Controller {

    private $_user_controller;

    public function __construct() {
        $this->_sql = new MontageSql();
        $this->_user_controller = new UserController();
    }

    /**
     * @return UserController
     */
    public function getUserController() {
        return $this->_user_controller;
    }

}