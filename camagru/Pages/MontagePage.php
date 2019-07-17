<?php


namespace Pages;

use Core\Page;
use App\Montage\MontageController;
use Core\Snackbar;

class MontagePage extends Page  {

    public function __construct($url) {
        parent::__construct($url);
        $this->_template = "templates/general";
        $this->_controller = new MontageController();
    }

    public function index() {
        $params = array('content' => 'general/Montage');
        $this->render($params);
    }

    public function new_post($picture) {
        if ($this->_controller->getGeneralController()->getUserController()->isLogged()) {
            if ($this->_controller->getSql()->upload_picture($this->_controller->getGeneralController()->getUserController()->get_user()['userid'], $picture)) {
                Snackbar::send_snack("Post uploded");
            } else {
                Snackbar::send_snack("Error while uploading post");
            }
            //$this->redirect("/");
        } else {
            Snackbar::send_snack("Please log-in");
            $this->redirect("/");
        }
    }

}