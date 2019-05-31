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
    public $health = 10;
    public $shield = 10;

    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
        $this->updateShape();
    }

    public function updateShape() {
        $this->shape = array();
        for ($shapeX = 0; $shapeX < $this->sizeX; $shapeX++) {
            for ($shapeY = 0; $shapeY < $this->sizeY; $shapeY++) {
                $this->shape[] = array("x" => $shapeX + $this->getX(), "y" => $shapeY + $this->getY());
                $this->getMap()->grid[$shapeY + $this->getY()][$shapeX + $this->getX()] = $this;
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

    /**
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param int $health
     */
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @return int
     */
    public function getShield()
    {
        return $this->shield;
    }

    /**
     * @param int $shield
     */
    public function setShield($shield)
    {
        $this->shield = $shield;
    }

    public function shoot() {
        $this->getPlayer()->removeMP(5);
        for ($i = 2; $i < 10; $i++) {
            if ($this->getMap()->getGrid()[$this->getY()][$this->getX() + $i] instanceof Ship) {
                $ship = $this->getMap()->getGrid()[$this->getY()][$this->getX() + $i];
                if ($ship->getShield() != 0) {
                    $ship->setShield($ship->getShield() - 5);
                } else {
                    $ship->setHealth($ship->getHealth() - 5);
                }
                return true;
            }
        }
        return false;
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
        if ($this->getMap()->updateLocation($this, $old_x, $old_y, $x, $y)) {
            $this->setX($x);
            $this->setY($y);
            $this->updateShape();
            $this->getPlayer()->removeMP(1);
            return true;
        }
        return false;
    }

}