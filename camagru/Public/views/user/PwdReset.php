<link href="/Public/assets/css/login.css" rel="stylesheet">
<div class="row">
    <div class="row-content">
        <div class="nav-content">
            <div class="nav">
                <a id="reset-button" class="active nav-big">
                    <span class="text active">Réinitialiser</span>
                    <span class="icon"><i class="fas fa-sync-alt"></i></span>
                </a>
            </div>
        </div>
        <div  id="reset-content" class="active content content-reset">
            <h2 class="title">Changer de mot de passe</h2>
            <form method="POST" action="/user/resetpw">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="hidden" name="reset_token" value="<?= htmlspecialchars(explode('/', $this->_url)[2]) ?>">
                <input type="password" name="password" id="password" class="form-control" placeholder="Nouveau mot de passe" required="" autofocus="">
                <input type="password" name="password_repeat" id="password_repeat" class="form-control" placeholder="Répéter" required="">
                <input class="button black" name="reset" value="Modifier" type="submit">
            </form>
        </div>
    </div>
</div>