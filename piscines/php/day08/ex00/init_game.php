<?php
session_start();

require_once 'classes/Game.class.php';

$game = new Game();

$game->setPlayers(array($_POST['player1'], $_POST['player2']));

$_SESSION['game'] = serialize($game);