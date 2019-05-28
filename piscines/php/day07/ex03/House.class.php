<?php


class House {

    public function introduce() {
        $name = $this->getHouseName();
        $seat = $this->getHouseSeat();
        $motto = $this->getHouseMotto();
        print ("House " . $name . " of " . $seat . " : \"" . $motto . "\"" . PHP_EOL);
    }

}