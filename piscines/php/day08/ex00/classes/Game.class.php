<?php

require_once 'Map.class.php';
class Game {

    private $_players;

    public function __construct()
    {
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

}