<style>
    .form {
        display: flex;
        max-width: 500px;
        margin: 0 auto;
    }
    form {
        margin: auto;
        width: 100%;
    }
    .c-button {
        width: 100%;
        height: 3rem;
        display: flex;
        position: absolute;
        bottom: 0;
        margin: 1rem 0;
    }

    .c-button .button-content {
        margin: 0 auto;
        width: 75%;
        position: relative;
        display: flex;
        background-color: #fafafa;
        border: 1px solid rgba(0,0,0,.0975);
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        -webkit-transition: border 0.2s ease-out, background 0.2s ease-out, color 0.2s ease-out, width 0.6s ease-out;
        -o-transition: border 0.2s ease-out, background 0.2s ease-out, color 0.2s ease-out, width 0.6s ease-out;
        transition: border 0.2s ease-out, background 0.2s ease-out, color 0.2s ease-out, width 0.6s ease-out;
    }
    .button {
        text-align: center;
        font-size: inherit;
        padding: 1rem 0;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        box-sizing: border-box;
        background-color: #2b3441;
        color: #fff;
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