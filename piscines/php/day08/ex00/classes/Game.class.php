<?php


class Game {

    private $_players;

    public function __construct()
    {
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