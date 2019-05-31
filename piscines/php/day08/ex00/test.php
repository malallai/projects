<?php

include_once 'assets/templates/header.php';
?>
    <link rel="stylesheet" href="assets/css/game.css">
    <div class="header">
        <div class="player-infos">
            <h1 class="player-name">Player 1</h1>
            <a class="health">Health : X</a>
            <a class="shield">Shield : X</a>
        </div>
        <div class="movements">
            <a class="move-point">X MP</a>
            <div class="move-key">
                <i class="material-icons">keyboard_arrow_left</i>
                <i class="material-icons">keyboard_arrow_up</i>
                <i class="material-icons">keyboard_arrow_down</i>
                <i class="material-icons">keyboard_arrow_right</i>
                <i class="material-icons">skip_next</i>
                <i class="fas fa-fire-alt"></i>
            </div>
        </div>
    </div>
    <hr>

    <div class="map">
        <table>
            <tr>
                <td class="reactive-nonmetal"><p class="mass">1.008</p><h2>H</h2><p class="atom">1</p></td>
                <td colspan="17"></td>
                <td class="noble-gas"><p class="mass">4.0026</p><h2>He</h2><p class="atom">2</p></td>
            </tr>
        </table>
    </div>

<?php
include_once 'assets/templates/footer.php';
