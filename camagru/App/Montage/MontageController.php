<?php

namespace App\Montage;

use App\General\GeneralController;
use App\User\UserController;
use Core\Controller;
use Core\Security;

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

    public static function get($page) {
        if (self::$_instance === null)
            return new MontageController($page);
        return self::$_instance;
    }

    public function getGeneralController() {
        return $this->_generalController;
    }

    public function getUserController() {
        return $this->_userController;
    }

    public function getPage() {
        return $this->_page;
    }

    public function getSql() {
        return $this->_sql;
    }

    public function merge42($post) {
        $filename = Security::newToken(8);
        $tmp = $this->base64_to_img($post['img'], 'Public/assets/pictures/tmp/' . Security::newToken(8) . '.jpeg');
        $tmpFilter = $this->base64_to_img($post['filterPicture'], 'Public/assets/pictures/tmp/' . Security::newToken(8) . '.png');
        $output = 'Public/assets/pictures/posts/'.$filename.'.jpeg';
        $px = $post['filterX'];
        $py = $post['filterY'];
        $scale = 1;
        $img = @imagecreatefromjpeg($tmp);
        if (!$img)
            return false;
        if (($diff  = (100 - (100 * $post['offW'] / imagesx($img)))) > 25)
            $scale = ($diff / 25) + 1;
        $img = imagescale($img, $post['offW'] * $scale, $post['offH'] * $scale);
        $filter = @imagecreatefrompng($tmpFilter);
        if (!$filter)
            return false;
        $filter = imagescale($filter, $post['offWF'] * $scale, $post['offHF'] * $scale);
        $x = $px * imagesx($img) / 100;
        $y = $py * imagesy($img) / 100;
        $result = imagecopy($img, $filter, $x, $y, 0, 0, imagesx($filter), imagesy($filter));
        if (!$result)
            return false;
        $result = imagepng($img, $output);
        if (!$result)
            return false;
        imagedestroy($img);
        imagedestroy($filter);
        unlink($tmp);
        unlink($tmpFilter);
        return $filename;
    }

    public function mergeSimple($post) {
        $filename = Security::newToken(8);
        $tmp = $this->base64_to_img($post['img'], 'Public/assets/pictures/tmp/' . Security::newToken(8) . '.png');
        $img = @imagecreatefromjpeg($tmp);
        if (!$img)
            return false;
        $output = 'Public/assets/pictures/posts/'.$filename.'.jpeg';
        if ($post['filter'] !== 'void')
            imagefilter($img,  IMG_FILTER_GRAYSCALE);
        if ($post['filter'] === 'sepia')
            imagefilter($img, IMG_FILTER_COLORIZE, 100, 50, 0);
        imagepng($img, $output);
        imagedestroy($img);
        unlink($tmp);
        return $filename;
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
            $output = $this->merge42($post);
        } else {
            $output = $this->mergeSimple($post);
        }
        if ($output) {
            if ($this->getSql()->upload_picture($this->getUserController()->getSessionId(), $output))
                return array("status" => "ok");
        }
        return array("status" => "error");
    }

}