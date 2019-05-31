<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Player.class.php';
require_once 'classes/Ship.class.php';

    if ($_SESSION['data']) {
        $game = unserialize($_SESSION['data']);

        $player = $game->getCurrentPlayer();

        if ($player->getMP() - 5 >= 0) {
            $return = $player->getShip()->shoot();

            $_SESSION['data'] = serialize($game);

            echo json_encode($return);
        } echo json_encode(false);
        return;
    }
