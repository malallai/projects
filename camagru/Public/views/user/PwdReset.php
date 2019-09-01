<link href="/Public/assets/css/form.css" rel="stylesheet">
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
            <form method="POST" action="/user/reset_password">
                <input type="hidden" name="token" value="<?= \Core\Security::getToken() ?>">
                <input type="hidden" name="reset_token" value="<?= Core\Security::convertChars(explode('/', $this->_url)[2]) ?>">
                <input type="password" name="password" id="password" class="form-control" placeholder="Nouveau mot de passe" required="" autofocus="">
                <input type="password" name="repeat" id="repeat" class="form-control" placeholder="Répéter" required="">
                <input class="c-button-input button-blue" name="reset" value="Modifier" type="submit">
            </form>
        </div>
    </div>
</div>