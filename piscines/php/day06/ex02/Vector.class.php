<?php

require_once '../ex01/Vertex.class.php';
class Vector {

    public static $verbose = False;
    private $_x;
    private $_y;
    private $_z;
    private $_w = 0.0;


    function doc() {
        if (file_exists("Vector.doc.txt")) {
            return file_get_contents("Vector.doc.txt");
        }
        return "";
    }

    function __construct(array $array) {
        $dest = $array['dest'];
        if(!array_key_exists('orig', $array))
            $array['orig'] = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0));
        $this->_x = $dest->getX() - $array['orig']->getX();
        $this->_y = $dest->getY() - $array['orig']->getY();
        $this->_z = $dest->getZ() - $array['orig']->getZ();
        if($array['dest']->getW())
            $this->_w = $dest->getW() - $array['orig']->getW();
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
        return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->getW()));
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

    public function getW() {
        return $this->_w;
    }

    public function magnitude() {
        return sqrt(pow($this->getX(), 2) + pow($this->getY(), 2) + pow($this->getZ(), 2));
    }

    public function normalize() {
        $magnitude = $this->magnitude();
        if ($magnitude) {
            $x = $this->getX() / $magnitude;
            $y = $this->getY() / $magnitude;
            $z = $this->getZ() / $magnitude;
            $new_vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
        } else {
            $new_vertex = new Vertex(array('x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 0.0));
        }
        return (new Vector(array('dest' => $new_vertex)));
    }

    public function add(Vector $vector) {
        $x = $this->getX() + $vector->getX();
        $y = $this->getY() + $vector->getY();
        $z = $this->getZ() + $vector->getZ();
        $new_vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
        return (new Vector(array('dest' => $new_vertex)));
    }

    public function sub(Vector $vector) {
        $x = $this->getX() - $vector->getX();
        $y = $this->getY() - $vector->getY();
        $z = $this->getZ() - $vector->getZ();
        $new_vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
        return (new Vector(array('dest' => $new_vertex)));
    }

    public function opposite() {
        $x = -$this->getX();
        $y = -$this->getY();
        $z = -$this->getZ();
        $new_vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
        return (new Vector(array('dest' => $new_vertex)));
    }

    public function scalarProduct($scalar) {
        $x = $this->getX() * $scalar;
        $y = $this->getY() * $scalar;
        $z = $this->getZ() * $scalar;
        $new_vertex = new Vertex(array('x' => $x, 'y' => $y, 'z' => $z));
        return (new Vector(array('dest' => $new_vertex)));
    }

    public function dotProduct(Vector $vector) {
        return ($this->getX() * $vector->getX() + $this->getY() * $vector->getY() + $this->getZ() * $vector->getZ());
    }

    public function cos(Vector $vector) {
        return($this->dotProduct($vector) / ($this->magnitude() * $vector->magnitude()));
    }

    public function crossProduct(Vector $vector) {
        $x = $this->getY() * $vector->getZ() - $vector->getY() * $this->getZ();
        $y = $this->getX() * $vector->getZ() - $vector->getX() * $this->getZ();
        $z = $this->getX() * $vector->getY() - $vector->getX() * $this->getY();
        $new_vertex = new Vertex(array('x' => $x, 'y' => -$y, 'z' => $z));
        return (new Vector(array('dest' => $new_vertex)));
    }

}