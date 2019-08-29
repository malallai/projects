<style>
    .form {
        display: flex;
        max-width: 50vw;
        margin: 0 auto;
    }
    form {
        margin: auto;
    }
    input {
        text-align: center;
        font-size: inherit;
        padding: .5rem 0;
        margin-bottom: .7rem;
        width: 100%;
        color: inherit;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        box-sizing: border-box;
        background-color: transparent;
        border: 1px solid rgba(0,0,0,.0975);
        border-radius: .25rem;
    }
</style>
<div class="form">
    <form action="/setup" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <input class="button" type="submit" name="submit" value="Setup Camagru ?">
    </form>
</div>