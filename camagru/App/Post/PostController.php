<?php

namespace App\Post;

use App\General\GeneralController;
use Core\Controller;
use Core\Page;

class PostController extends Controller {

    private $_generalController;

    public function __construct($page) {
        $this->_sql = new PostSql();
        $this->_generalController = new GeneralController();
        $this->_page = $page;
    }

    /**
     * @return Page
     */
    public function getPage() {
        return $this->_page;
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

    public function checkPost($args) {
        if (!$this->getGeneralController()->getUserController()->isLogged()) {
            $this->getPage()->redirect("/user");
            return false;
        }
        if (!isset($args['id']) || !isset($args['token']) || !GeneralController::compareTokens($args['token'])
            || !$this->getSql()->postExist($args['id']))
            return false;
        return true;
    }
}