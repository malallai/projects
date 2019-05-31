<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Player.class.php';
require_once 'classes/Ship.class.php';

if (isset($_POST['direction'])) {
    if ($_SESSION['data']) {
        $game = unserialize($_SESSION['data']);

        $player = $game->getCurrentPlayer();
        if ($player->getMP() - 1 >= 0) {
            $return = $player->getShip()->move($_POST['direction']);
            $_SESSION['data'] = serialize($game);
            echo json_encode($return);
        } else echo json_encode(false);
        return;
    }
}