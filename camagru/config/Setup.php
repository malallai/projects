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
    .button {
        cursor: pointer;
        width: 100%;
        text-align: center;
        font-size: inherit;
        padding: 1rem 0;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        box-sizing: border-box;
        background-color: #2b3441;
        color: #fff;
        border: 1px solid rgba(0,0,0,.0975);
        border-radius: 2px;
    }
    .button:hover {
        background-color: #202020;
    }
</style>
<div class="form">
    <form action="/setup" method="post">
        <input type="hidden" name="token" value="<?= $token ?>">
        <input class="button" type="submit" name="submit" value="Setup Camagru ?">
    </form>
</div>