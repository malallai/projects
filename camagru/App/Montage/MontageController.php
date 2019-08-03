<?php

namespace App\Montage;

use App\General\GeneralController;
use Core\Controller;
use Core\Page;
use Core\Snackbar;

class MontageController extends Controller {

    private $_generalController;
    protected static $_instance = null;

    public function __construct($page) {
        if (self::$_instance === null) {
            self::$_instance = $this;
            $this->_sql = new MontageSql();
            $this->_page = $page;
            $this->_generalController = GeneralController::get($page);
        }
    }

    /**
     * @var page Page
     * @return MontageController
     */
    public static function get($page) {
        if (self::$_instance === null)
            return new MontageController($page);
        return self::$_instance;
    }

    /**
     * @return GeneralController
     */
    public function getGeneralController() {
        return $this->_generalController;
    }

    /**
     * @return Page
     */
    public function getPage() {
        return $this->_page;
    }

    /**
     * @return MontageSql
     */
    public function getSql() {
        return $this->_sql;
    }

    public function newPost($picture) {
        if ($this->getGeneralController()->getUserController()->isLogged()) {
            if (!$this->getSql()->upload_picture($this->getGeneralController()->getUserController()->getSessionId(), $picture)) {
                Snackbar::sendSnack("Error while uploading post");
            }
        } else {
            Snackbar::sendSnack("Please log-in");
        }
        $this->getPage()->redirect("/");
    }

}