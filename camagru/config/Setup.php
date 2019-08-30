<style>
    .c-button-input {
        width: 50%;
    }
</style>
<div class="form">
    <div class="infos">
        <h1 class="title">Camagru</h1>
        <p>Configurer Camagru ?</p>
    </div>
    <form action="/setup" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <input class="c-button-input button-light-blue" type="submit" name="submit" value="Setup Camagru ?">
    </form>
</div>