<?php
if ($_SERVER['REQUEST_URI'] !== "/setup") {
    header("Location: /setup");
    die();
}
?>
<style>
    .c-button-input {
        width: 50%;
        margin: 0 auto;
        display: flex;
    }
</style>
<div class="infos">
    <h1 class="title">Camagru</h1>
    <p>Configurer Camagru ? Cette action aura pour effets d'initialiser une base de donnée vide.</p>
</div>
<div class="form">
    <form action="/setup" method="post">
        <input type="hidden" name="token" value="<?= \Core\Security::getToken() ?>">
        <input class="c-button-input button-light-blue" type="submit" name="submit" value="Ok">
    </form>
</div>
<div class="c-button">
    <div class="button-red button-content">
        <a href="/user/logout"><span>Déconnexion</span></a>
    </div>
</div>