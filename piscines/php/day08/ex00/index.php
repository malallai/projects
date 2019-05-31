<?php

session_start();

include_once 'assets/templates/header.php';
require_once 'classes/Map.class.php';
require_once 'classes/Game.class.php';

if (isset($_SESSION['data'])) {
    $data = unserialize($_SESSION['data']);
    include 'game.php';
    $data->getMap()->draw();
} else include 'main.php';

include_once 'assets/templates/footer.php';
