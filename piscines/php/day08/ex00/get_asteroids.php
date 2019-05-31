<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Asteroid.class.php';
if ($_POST['val'] === "get") {
    if ($_SESSION['data']) {
        $game = unserialize($_SESSION['data']);
        $array = array();

        foreach ($game->getMap()->getAsteroids() as $asteroid) {
            $array[] = array("asteroid" => $asteroid->getShape());
        }

        echo json_encode($array);
        return;
    }
    echo json_encode(array("nop"));
}