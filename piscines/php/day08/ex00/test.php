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
                <i class="material-icons">filter_center_focus</i>
                <i class="material-icons">skip_next</i>
            </div>
        </div>
    </div>
    <hr>

    <div class="map">
        <table>
            <tr>
                <td class="ship blue"></td>
                <td class="ship blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="ship blue"></td>
                <td class="ship blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="ship red"></td>
                <td class="ship red"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="ship red"></td>
                <td class="ship red"></td>
            </tr>
        </table>
    </div>

<?php
include_once 'assets/templates/footer.php';
