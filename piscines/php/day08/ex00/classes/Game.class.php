<?php

require_once 'Map.class.php';
require_once 'Player.class.php';
class Game {

    private $_players;
    private $_map;

    public function __construct()
    {
        $this->_map = new Map(40, 20);
    }

    /**
     * @param mixed $players
     */
    public function setPlayers($players)
    {
        $p1 =  new Player($this->_map, 0, 0);
        $p2 =  new Player($this->_map, 0, 0);
        $this->_map->addPlayer($p1);
        $p1->setName($players[0]);
        $p1->setShip(new Ship($this->_map, 2, 5));
        $p1->getShip()->setColor('red');
        $this->_map->addPlayer($p2);
        $p2->setName($players[1]);
        $p2->setShip(new Ship($this->_map, 36, 5));
        $p2->getShip()->setColor('blue');
        $this->_players = array($p1, $p2);
    }

    /**
     * @return array(Player)
     */
    public function getPlayers()
    {
        return $this->_players;
    }

    /**
     * @return Map
     */
    public function getMap()
    {
        return $this->_map;
    }

}