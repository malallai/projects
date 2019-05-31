<?php

require_once 'SpaceEntity.class.php';
require_once 'Ship.class.php';
require_once 'Map.class.php';
class Player extends SpaceEntity {

    public $name;
    public $ship;

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



}