<?php

require_once 'SpaceEntity.class.php';
require_once 'Map.class.php';
require_once 'Player.class.php';
require_once 'Direction.class.php';
class Ship extends SpaceEntity {

    public $owner;
    public $shape;
    public $sizeX = 2;
    public $sizeY = 2;
    public $color;

    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
        $this->updateShape();
    }

    public function updateShape() {
        $this->shape = array();
        for ($shapeX = 0; $shapeX < $this->sizeX; $shapeX++) {
            for ($shapeY = 0; $shapeY < $this->sizeY; $shapeY++) {
                $this->shape[] = array("x" => $shapeX + $this->getX(), "y" => $shapeY + $this->getY());
            }
        }
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
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

    public function move($direction) {
        $old_x = $this->getX();
        $old_y = $this->getY();
        $x = $old_x;
        $y = $old_y;
        switch ($direction) {
            case Direction::up:
                $x = $old_x;
                $y = $old_y - 1;
                break;
            case Direction::down:
                $x = $old_x;
                $y = $old_y + 1;
                break;
            case Direction::left:
                $x = $old_x - 1;
                $y = $old_y;
                break;
            case Direction::right:
                $x = $old_x + 1;
                $y = $old_y;
                break;
            default : break;
        }

        if (!$this->getMap()->updateLocation($this, $old_x, $old_y, $x, $y)) {
            $this->setX($x);
            $this->setY($y);
            $this->updateShape();
            return true;
        } else {
            return false;
        }
    }

}