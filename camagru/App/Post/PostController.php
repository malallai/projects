<?php

namespace App\General\Post;

use App\General\GeneralController;
use Core\Controller;
class PostController extends Controller {

    private $_generalController;

    public function __construct() {
        $this->_sql = new PostSql();
        $this->_generalController = new GeneralController();
    }

    /**
     * @return GeneralController
     */
    public function getGeneralController() {
        return $this->_generalController;
    }

    /**
     * @return PostSql
     */
    public function getSql() {
        return $this->_sql;
    }
}