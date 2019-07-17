<?php

namespace App\Montage;

use App\General\GeneralController;
use Core\Controller;

class MontageController extends Controller {

    private $_generalController;

    public function __construct() {
        $this->_sql = new MontageSql();
        $this->_generalController = new GeneralController();
    }

    /**
     * @return GeneralController
     */
    public function getGeneralController() {
        return $this->_generalController;
    }

}