<?php
require_once 'classes/Game.class.php';

$game = new Game();

$game->setName("TestGame");

$_SESSION['game'] = serialize($this);