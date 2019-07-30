<?php

namespace App\Montage;

use App\General\GeneralController;
use Core\Controller;
use Core\Page;
use Core\Snackbar;

class MontageController extends Controller {

    private $_generalController;

    public function __construct($page) {
        $this->_sql = new MontageSql();
        $this->_generalController = new GeneralController();
        $this->_page = $page;
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