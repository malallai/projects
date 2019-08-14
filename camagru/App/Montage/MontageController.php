<?php

namespace App\Montage;

use App\General\GeneralController;
use App\User\UserController;
use Core\Controller;
use Core\Page;
use Core\Security;
use Core\Snackbar;

class MontageController extends Controller {

    private $_generalController;
    private $_userController;
    protected static $_instance = null;

    public function __construct($page) {
        if (self::$_instance === null) {
            self::$_instance = $this;
            $this->_sql = new MontageSql();
            $this->_page = $page;
            $this->_generalController = GeneralController::get($page);
            $this->_userController = UserController::get($page);
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
     * @return UserController
     */
    public function getUserController() {
        return $this->_userController;
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

    public function merge42($post) {
        $tmp = $this->base64_to_img($post['img'], 'Public/assets/pictures/tmp/' . Security::newToken(8) . '.jpeg');
        $tmpFilter = $this->base64_to_img($post['filterPicture'], 'Public/assets/pictures/tmp/' . Security::newToken(8) . '.png');
        $output = 'Public/assets/pictures/posts/'.Security::newToken(8).'.jpeg';
        $size = $post['width'];
        $x = $post['x'];
        $y = $post['y'];
        $img = imagecreatefromjpeg($tmp);
        $filter = imagecreatefromjpeg($tmpFilter);
        imagealphablending($filter, false);
        imagesavealpha($filter, true);
        imagecopymerge($img, $filter, 10, 9, 0, 0, 181, 180, 100);
        imagepng($img, $output);
        imagedestroy($img);
        imagedestroy($filter);
        //unlink($tmp);
        //unlink($tmpFilter);
        return $output;
    }

    public function mergeSimple($post) {
        $tmp = $this->base64_to_img($post['img'], 'Public/assets/pictures/tmp/' . Security::newToken(8) . '.jpeg');
        $img = imagecreatefromjpeg($tmp);
        $output = 'Public/assets/pictures/posts/'.Security::newToken(8).'.jpeg';
        if ($post['filter'] !== 'void')
            imagefilter($img,  IMG_FILTER_GRAYSCALE);
        if ($post['filter'] === 'sepia')
            imagefilter($img, IMG_FILTER_COLORIZE, 100, 50, 0);
        imagepng($img, $output);
        imagedestroy($img);
        unlink($tmp);
        return $output;
    }

    public function base64_to_img($string, $output_file) {
        if (!file_exists("Public/assets/pictures/tmp"))
            mkdir("Public/assets/pictures/tmp");
        $ifp = fopen($output_file, 'wb' );
        fwrite($ifp, base64_decode($string));
        fclose($ifp);
        return $output_file;
    }

    public function newPost($post) {
        if ($post['filter'] === "42") {
            if ($output = $this->merge42($post)) {
                return array("status" => "ok", "file" => $output);
            }
        } else {
            if ($output = $this->mergeSimple($post)) {
                return array("status" => "ok", "file" => $output);
            }
        }
    }

}