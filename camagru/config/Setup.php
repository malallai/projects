<style>
    form {
        display: flex;
        max-width: 50vw;
        margin: 0 auto;
    }
</style>
<form action="/setup" method="post">
    <input type="hidden" name="token" value="<?= $token ?>">
    <input class="button" type="submit" name="submit" value="Setup Camagru ?">
</form>