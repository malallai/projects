<?php

require_once 'SpaceEntity.class.php';
require_once 'Map.class.php';
require_once 'Player.class.php';
class Ship extends SpaceEntity {

    public $owner;
    public $shape;
    public $sizeX = 2;
    public $sizeY = 2;

    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
        for ($shapeX = 0; $shapeX < $this->sizeX; $shapeX++) {
            for ($shapeY = 0; $shapeY < $this->sizeY; $shapeY++) {
                $this->shape[] = array("x" => $shapeX + $x, "y" => $shapeY + $y);
            }
        }
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->owner;
    }

    /**
     * @param Player $owner
     */
    public function setPlayer(Player $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return mixed
     */
    public function getShape()
    {
        return $this->shape;
    }

}