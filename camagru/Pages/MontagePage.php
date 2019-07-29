<?php


namespace Pages;

use Core\Page;
use App\Montage\MontageController;
use Core\Snackbar;

class MontagePage extends Page  {

    public function __construct($router, $url) {
        parent::__construct($router, $url);
        $this->_template = "templates/general";
        $this->_controller = new MontageController();
    }

    public function index() {
        $params = array('content' => 'general/Montage');
        $this->render($params);
    }

    public function newPost($picture) {
        if ($this->_controller->getGeneralController()->getUserController()->isLogged()) {
            if (!$this->_controller->getSql()->upload_picture($this->_controller->getGeneralController()->getUserController()->getSessionId(), $picture)) {
                Snackbar::sendSnack("Error while uploading post");
            }
            $this->redirect("/");
        } else {
            Snackbar::sendSnack("Please log-in");
            $this->redirect("/");
        }
    }

}