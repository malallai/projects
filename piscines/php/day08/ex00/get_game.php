<?php

session_start();

require_once 'classes/Game.class.php';

if ($_SESSION['game'] && $_POST['val'] === "get") {
    $game = unserialize($_SESSION['game']);
    $array = array();

    $array['players'] = $game->getPlayers();

    echo json_encode($array);
}
echo json_encode(array("nop"));