<?php
session_start();

require_once 'classes/Game.class.php';

global $data;

$game = new Game();
$game->setPlayers(array($_POST['player1'], $_POST['player2']));

$_SESSION['data'] = serialize($game);