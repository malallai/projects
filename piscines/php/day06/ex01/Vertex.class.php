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
            echo $this . " constructed".PHP_EOL;
        }
    }

    function __destruct() {
        if (self::$verbose) {
            echo $this . " destructed".PHP_EOL;
        }
    }

    function __toString() {
        if (self::$verbose) {
            return sprintf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )', $this->getX(), $this->getY(), $this->getZ(), $this->getW(), $this->_color);
        } else {
            return sprintf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )', $this->getX(), $this->getY(), $this->getZ(), $this->getW());
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