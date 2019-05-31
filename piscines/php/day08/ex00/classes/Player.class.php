<?php

require_once 'SpaceEntity.class.php';
require_once 'Ship.class.php';
require_once 'Map.class.php';
class Player extends SpaceEntity {

    public $name;
    public $ship;
    public $mp = 7;

    public static function doc() {
        if (file_exists("doc/Player.doc.txt")) {
            return file_get_contents("doc/Player.doc.txt");
        }
        return "";
    }

    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Ship
     */
    public function getShip()
    {
        return $this->ship;
    }

    /**
     * @param Ship $ship
     */
    public function setShip(Ship $ship)
    {
        $this->ship = $ship;
        $this->ship->setPlayer($this);
    }

    /**
     * @return int
     */
    public function getMp()
    {
        return $this->mp;
    }

    /**
     * @param int $mp
     */
    public function setMp($mp)
    {
        $this->mp = $mp;
    }

    public function removeMP($count) {
        $this->setMp($this->getMp() - $count);
    }

    public function addMP($count) {
        $this->setMp($this->getMp() + $count);
    }

    public function getInfos() {
        return array("name"=>$this->getName(), "health"=>$this->getShip()->getHealth(), "shield"=>$this->getShip()->getShield(), "mp"=>$this->getMp());
    }

}