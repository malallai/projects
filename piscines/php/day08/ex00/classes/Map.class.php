<?php

require_once 'Void.class.php';
require_once 'Asteroid.class.php';
class Map {

    private $_sizeX = 40;
    private $_sizeY = 20;
    private $_grid;
    private $_asteroid_count = 4;
    private $_asteroids;


    public function __construct($sizeX, $sizeY) {
        $this->_sizeX = $sizeX;
        $this->_sizeY = $sizeY;
        $this->init_grid();
    }

    public function init_grid() {
        for ($y = 0; $y < $this->_sizeY; $y++) {
            for ($x = 0; $x < $this->_sizeX; $x++) {
                $this->_grid[$y][$x] = new Void($this, $x, $y);
            }
        }
        for ($i = 0; $i < $this->_asteroid_count; $i++) {
            $x = rand(0, $this->_sizeX);
            $y = rand(0, $this->_sizeY);
            $this->_grid[$y][$x] = $tmp = new Asteroid($this, $x, $y);
            $this->_asteroids[] = $tmp;
        }
    }

    public function addShip(Ship $ship) {
        $this->_grid[$ship->getY()][$ship->getX()] = $ship;
    }

    public function draw() {
        echo "<table>";
        for ($y = 0; $y < $this->_sizeY; $y++) {
            echo "<tr id='$y'>";
            for ($x = 0; $x < $this->_sizeX; $x++) {
                echo "<td id='$x'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    public function updateLocation($old_x, $old_y, $x, $y) {
        if (!$this->checkCollision($x, $y)) {
            return false;
        }
        $this->_grid[$old_y][$old_x] = new Void($this, $old_x, $old_y);
        $this->_grid[$y][$x] = new Void($this, $old_x, $old_y);
        return true;
    }

    public function checkCollision($x, $y) {
        if (!($this->_grid[$y][$x] instanceof Void))
            return false;
        if (!($this->_grid[$y][$x + 1] instanceof Void))
            return false;
        if (!($this->_grid[$y + 1][$x] instanceof Void))
            return false;
        if (!($this->_grid[$y + 1][$x + 1] instanceof Void))
            return false;
        if ($x < 0 || $x + 1 > !$this->_sizeX)
            return false;
        if ($y < 0 || $y + 1 > !$this->_sizeY)
            return false;
        return true;
    }

    /**
     * @return mixed
     */
    public function getAsteroids()
    {
        return $this->_asteroids;
    }

}