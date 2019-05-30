<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Game | D08</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div class="background"></div>
<main>
    <div class="container">
        <div class="top-nav-row">
            <div class="top-nav-content">
                <div class="top-nav">
                    <a class="active">New Game</a>
                    <a class="">Scores</a>
                </div>
            </div>
        </div>

        <div class="new-game-row hidden">
            <div class="new-game-content">
                <p>New Game</p>
                <div class="new-game">
                    <form>
                        <input type="text" id="player1" class="form-control" placeholder="Player 1">
                        <input type="text" id="player2" class="form-control" placeholder="Player 2">
                        <input class="btn btn-white" name="play" value="Play" type="submit">
                    </form>
                </div>
            </div>
        </div>
        <div class="scores-row visible">
            <div class="scores-content">
                <p>New Game</p>
                <div class="scores">
                    <div class="score">
                        <p class="place">1</p>
                        <p class="player-name">TestPlayer</p>
                        <p class="player-score">10</p>
                    </div>
                    <div class="score">
                        <p class="place">2</p>
                        <p class="player-name">TestPlayer</p>
                        <p class="player-score">10</p>
                    </div>
                    <div class="score">
                        <p class="place">3</p>
                        <p class="player-name">TestPlayer</p>
                        <p class="player-score">10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
