<?php

require_once 'Map.class.php';
class Game {

    private $_players;
    private $_map;

    public function __construct()
    {
        $this->_map = new Map();
    }

    public function __toString()
    {
        return (sprintf("Game ( %s )", $this->getMap()));
    }

    /**
     * @param mixed $players
     */
    public function setPlayers($players)
    {
        $this->_players = $players;
    }

    /**
     * @return mixed
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