<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Player.class.php';
require_once 'classes/Ship.class.php';

if (isset($_POST['direction'])) {
    if ($_SESSION['data']) {
        $game = unserialize($_SESSION['data']);

        $player = $game->getCurrentPlayer();

        if ($player->getShip()->move($_POST['direction']) === false) {
            echo "false";
        } else echo "true";

        return;
    }
}