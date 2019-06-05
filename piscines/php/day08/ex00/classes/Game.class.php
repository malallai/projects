<?php

require_once 'Map.class.php';
require_once 'Player.class.php';
class Game {

    private $_players;
    private $_map;
    public  $current_player;

    public static function doc() {
        if (file_exists("doc/Game.doc.txt")) {
            return file_get_contents("doc/Game.doc.txt");
        }
        return "";
    }

    public function __construct()
    {
        $this->_map = new Map(100, 75);
    }

    /**
     * @param mixed $players
     */
    public function setPlayers($players)
    {
        $p1 =  new Player($this->_map, 0, 0);
        $p2 =  new Player($this->_map, 0, 0);

        $this->setCurrentPlayer($p1);

        $p1->setName($players[0]);
        $p1->setShip(new Ship($this->_map, 2, 5));
        $p1->getShip()->setColor('red');

        $p2->setName($players[1]);
        $p2->setShip(new Ship($this->_map, 36, 5));
        $p2->getShip()->setColor('blue');
        $this->_players = array($p1, $p2);
    }

    public function getNextPlayer() {
        foreach ($this->getPlayers() as $player) {
            if ($this->getCurrentPlayer() !== $player)
                return $player;
        }
        return $this->getCurrentPlayer();
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

    /**
     * @return mixed
     */
    public function getCurrentPlayer()
    {
        return $this->current_player;
    }

    /**
     * @param mixed $current_player
     */
    public function setCurrentPlayer($current_player)
    {
        $this->current_player = $current_player;
    }



}
