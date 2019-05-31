<?php


class Map {

    private $_sizeX = 40;
    private $_sizeY = 20;
    private $_grid;
    private $_asteroid_count = 2;
    private $_asteroids;


    public function __construct($sizeX, $sizeY) {
        $this->_sizeX = $sizeX;
        $this->_sizeY = $sizeY;
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

    public function addPlayer(Player $player) {
        $this->_grid[$player->getX()][$player->getY()] = $player;
    }

    public function addShip(Ship $ship) {
        $this->_grid[$ship->getX()][$ship->getY()] = $ship;
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

    /**
     * @return mixed
     */
    public function getAsteroids()
    {
        return $this->_asteroids;
    }

}