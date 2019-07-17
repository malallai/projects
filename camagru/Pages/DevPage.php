<?php

namespace Pages;
use App\General\GeneralController;
use Core\Page;
use Core\Snackbar;

class DevPage extends Page {

    public function __construct($url) {
        parent::__construct($url);
        $this->_controller = new GeneralController();
        $this->_template = "templates/general";

    }

    public function index() {
        $posts = $this->_controller->getSql()->getPosts(1);
        $params = array('content' => 'dev/Test', "posts" => $posts);
        Snackbar::send_snack(DevPage::renderArray($params));
        $this->render($params);
    }

    public function mail() {
        $params = array('content' => 'mail/Template');
        $this->render($params);
    }

    public static function renderArray($values) {
        ob_start();
        var_dump($values);
        $content = ob_get_clean();
        return $content;
    }

}