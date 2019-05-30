<?php

require_once 'classes/Game.class.php';

if ($_SESSION['game'] && $_POST['val'] === "get") {
    $game = unserialize($_SESSION['game']);
    $array = array();

    $array['name'] = $game->getName();

    echo json_encode($array);
}