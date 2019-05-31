<?php


class Map {

    private $_sizeX = 100;
    private $_sizeY = 40;

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