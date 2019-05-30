<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Game | D08</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="assets/js/main.js"></script>
</head>
<body>
<div class="background"></div>
<main>
    <div class="container">
        <div class="top-nav-row">
            <div class="top-nav-content">
                <div class="top-nav">
                    <a id="new-game" class="active">New Game</a>
                    <a id="scores" class="">Scores</a>
                </div>
            </div>
        </div>

        <div id="new-game-form" class="new-game-row">
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
        <div id="scores-row" class="scores-row hidden">
            <div class="scores-content">
                <p>New Game</p>
                <div class="scores">
                    <div class="score">
                        <p class="player-name">TestPlayer</p>
                        <p class="player-score">10</p>
                    </div>
                    <div class="score">
                        <p class="player-name">TestPlayer</p>
                        <p class="player-score">10</p>
                    </div>
                    <div class="score">
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
