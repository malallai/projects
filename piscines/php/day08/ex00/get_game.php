<?php

session_start();

require_once 'classes/Game.class.php';

if ($_SESSION['game']) {
    $game = unserialize($_SESSION['game']);
    $array = array();

    $array['players'] = $game->getPlayers();

    echo json_encode($array);
    return;
}
echo json_encode(array("nop"));