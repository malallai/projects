<?php

session_start();

include_once 'assets/templates/header.php';

if (isset($_SESSION['game'])) {
    $game = unserialize($_SESSION['game']);

    include 'game.php';
    $game->getMap()->draw();
} else include 'main.php';

include_once 'assets/templates/footer.php';
