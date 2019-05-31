<?php
session_start();

require_once 'classes/Game.class.php';

$data = array();

$game = new Game();
$game->setPlayers(array($_POST['player1'], $_POST['player2']));

$map = new Map();

$data['game'] = $game;
$data['map'] = $map;