<?php


class Map {

    private $_sizeX = 40;
    private $_sizeY = 20;
    private $_grid;

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
            echo "<tr id='y=$y'>";
            for ($x = 0; $x < $this->_sizeX; $x++) {
                echo "<td id='x=$x'></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

}