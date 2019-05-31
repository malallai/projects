<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Player.class.php';
require_once 'classes/Ship.class.php';

if ($_POST['val'] === "get") {
    if ($_SESSION['data']) {
        $game = unserialize($_SESSION['data']);
        $array = array();

        foreach ($game->getPlayers() as $player) {
            $array[] = array("player_name" => $player->getName(), "ship" => $player->getShip()->getShape());
        }

        echo json_encode($array);
        return;
    }
    echo json_encode(array("nop"));
}