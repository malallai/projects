<?php


class Map {

    private $_sizeX = 80;
    private $_sizeY = 50;

    public function draw() {
        echo "<table>";
        for ($y = 0; $y < $this->_sizeY; $y++) {
            echo "<tr id='y=$y'>";
            for ($x = 0; $x < $this->_sizeX; $x++) {
                echo "<td id='x=$x></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

}