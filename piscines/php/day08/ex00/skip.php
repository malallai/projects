<?php

session_start();

require_once 'classes/Game.class.php';
require_once 'classes/Player.class.php';
require_once 'classes/Ship.class.php';

if ($_SESSION['data']) {
    $game = unserialize($_SESSION['data']);

    $player = $game->getCurrentPlayer();
    $player->setMP(8);
    $game->setCurrentPlayer($game->getNextPlayer());

    $_SESSION['data'] = serialize($game);
    echo json_encode(true);
    return;
}
