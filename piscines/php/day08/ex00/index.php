<?php

session_start();

require_once 'classes/Game.class.php';

if (isset($_SESSION['game'])) {
    $game = unserialize($_SESSION['game']);
} else {
    $game = new Game();
    require_once 'newgame.php';
}