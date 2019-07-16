<?php

namespace App\Montage;

use Core\Controller;

class MontageController extends Controller {

    public function __construct() {
        $this->_sql = new MontageSql();
    }

}