<?php

require_once 'Void.class.php';
require_once 'Asteroid.class.php';
class Map {

    private $_sizeX = 40;
    private $_sizeY = 20;
    public $grid;
    private $_asteroid_count = 5;
    private $_asteroids;

    public static function doc() {
        if (file_exists("doc/Map.doc.txt")) {
            return file_get_contents("doc/Map.doc.txt");
        }
        return "";
    }

    public function __construct($sizeX, $sizeY) {
        $this->_sizeX = $sizeX;
        $this->_sizeY = $sizeY;
        $this->init_grid();
    }

    public function init_grid() {
        for ($y = 0; $y < $this->_sizeY; $y++) {
            for ($x = 0; $x < $this->_sizeX; $x++) {
                $this->grid[$y][$x] = new Void($this, $x, $y);
            }
        }
        for ($i = 0; $i < $this->_asteroid_count; $i++) {
            $x = rand(0, $this->_sizeX);
            $y = rand(0, $this->_sizeY);
            $this->grid[$y][$x] = ($tmp = new Asteroid($this, $x, $y));
            $this->_asteroids[] = $tmp;
        }
    }

    public function addShip(Ship $ship) {
        $this->grid[$ship->getY()][$ship->getX()] = $ship;
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

    public function updateLocation(Ship $ship, $old_x, $old_y, $x, $y) {
        if (!$this->checkCollision($ship, $x, $y)) {
            return false;
        }
        $this->grid[$old_y][$old_x] = new Void($this, $old_x, $old_y);
        $this->grid[$y][$x] = new Void($this, $old_x, $old_y);
        return true;
    }

    public function checkCollision(Ship $ship, $x, $y) {
        if ($this->grid[$y][$x] instanceof Asteroid || ($this->grid[$y][$x] instanceof Ship && $this->grid[$y][$x] !== $ship))
            return false;
        if ($this->grid[$y][$x + 1] instanceof Asteroid || ($this->grid[$y][$x + 1] instanceof Ship && $this->grid[$y][$x + 1] !== $ship))
            return false;
        if ($this->grid[$y + 1][$x] instanceof Asteroid || ($this->grid[$y + 1][$x] instanceof Ship && $this->grid[$y + 1][$x] !== $ship))
            return false;
        if ($this->grid[$y + 1][$x + 1] instanceof Asteroid || ($this->grid[$y + 1][$x + 1] instanceof Ship && $this->grid[$y + 1][$x + 1] !== $ship))
            return false;
        if ($x < 0 || $x + 1 >= $this->_sizeX)
            return false;
        if ($y < 0 || $y + 1 >= $this->_sizeY)
            return false;
        return true;
    }

    /**
     * @return mixed
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @return mixed
     */
    public function getAsteroids()
    {
        return $this->_asteroids;
    }

}
