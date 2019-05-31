<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Asteroid.class.php';
        $game = unserialize($_SESSION['data']);
        $array = array();
        $array[] = array("grid" => $game->getMap()->getGrid());
        echo json_encode($array);
        return;
