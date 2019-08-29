<?php

namespace App\Setup;

use Core\Controller;
use Core\Page;

class SetupController extends Controller {
    protected static $_instance = null;

    public function __construct($page) {
        if (self::$_instance === null) {
            self::$_instance = $this;
            $this->_sql = new SetupSql();
            $this->_page = $page;
        }
    }

    /**
     * @var page Page
     * @return SetupController
     */
    public static function get($page) {
        if (self::$_instance === null)
            return new SetupController($page);
        return self::$_instance;
    }

    /**
     * @return Page
     */
    public function getPage() {
        return $this->_page;
    }

    /**
     * @return SetupSql
     */
    protected function getSql() {
        return $this->_sql;
    }

    public function setup() {
        return $this->getSql()->setup();
    }

}