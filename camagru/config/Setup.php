<style>
    .form {
        display: flex;
        max-width: 500px;
        margin: 0 auto;
    }
    form {
        margin: auto;
        width: 50%;
    }
</style>
<div class="form">
    <form action="/setup" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <input class="c-button-input button-blue" type="submit" name="submit" value="Setup Camagru ?">
    </form>
</div>