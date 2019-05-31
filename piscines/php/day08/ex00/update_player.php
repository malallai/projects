<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Player.class.php';
require_once 'classes/Ship.class.php';

if ($_POST['val'] === "get") {
    if ($_SESSION['data']) {
        $game = unserialize($_SESSION['data']);
        $array = array();
        $player = $game->getCurrentPlayer();

        $array[] = array("player" => $player->getInfos(), "ship" => $player->getShip()->getShape(), "color" => $player->getShip()->getColor());

        echo json_encode($array);
        return;
    }
    echo json_encode(array("nop"));
}