<?php

require_once ('../ex00/Color.class.php');
class Vertex {

    public static $verbose = False;
    private $_x;
    private $_y;
    private $_z;
    private $_w = 1.0;
    private $_color;

    public static function doc() {
        if (file_exists("Vertex.doc.txt")) {
            return file_get_contents("Vertex.doc.txt");
        }
        return "";
    }

    function __construct(array $array) {
        $this->_x = $array['x'];
        $this->_y = $array['y'];
        $this->_z = $array['z'];
        if (array_key_exists('w', $array)) {
            $this->_w = $array['w'];
        }
        if (array_key_exists('color', $array)) {
            $this->_color = $array['color'];
        } else {
            $this->_color = new Color(array('red' => 255, 'green' => 255, 'blue' => 255));
        }
        if (self::$verbose) {
            echo $this . " constructed\n";
        }
    }

    function __destruct() {
        if (self::$verbose) {
            echo $this . " destructed\n";
        }
    }

    function __toString() {
        if (self::$verbose) {
            return 'Vertex( x: ' . sprintf("%.2f", $this->getX()) . ', y: ' . sprintf("%.2f", $this->getY()) . ', z:' . sprintf("%.2f", $this->getZ()) . ', w:' . sprintf("%.2f", $this->getW()) . ', ' . $this->_color .' )';
        } else {
            return 'Vertex( x: ' . sprintf("%.2f", $this->getX()) . ', y: ' . sprintf("%.2f", $this->getY()) . ', z:' . sprintf("%.2f", $this->getZ()) . ', w:' . sprintf("%.2f", $this->getW()) .' )';
        }
    }

    public function getColor() {
        return $this->_color;
    }

    public function getW() {
        return $this->_w;
    }

    public function getX() {
        return $this->_x;
    }

    public function getY() {
        return $this->_y;
    }

    public function getZ() {
        return $this->_z;
    }

    public function setX($x)
    {
        $this->_x = $x;
    }

    public function setY($y)
    {
        $this->_y = $y;
    }

    public function setZ($z)
    {
        $this->_z = $z;
    }

    public function setW($w)
    {
        $this->_w = $w;
    }

    public function setColor($color)
    {
        $this->_color = $color;
    }

}