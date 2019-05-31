<?php

require_once 'Map.class.php';
require_once 'Entity.class.php';
class SpaceEntity implements Entity {

    private $_map;
    private $_x;
    private $_y;

    public static function doc() {
        if (file_exists("doc/SpaceEntity.doc.txt")) {
            return file_get_contents("doc/SpaceEntity.doc.txt");
        }
        return "";
    }

    public function __construct(Map $map, $x, $y) {
        $this->_map = $map;
        $this->_x = $x;
        $this->_y = $y;
    }

    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->_map;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->_x = $x;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->_y = $y;
    }




}