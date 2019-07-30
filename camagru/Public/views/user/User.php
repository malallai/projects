<link href="/Public/assets/css/login.css" rel="stylesheet">
<script src='/Public/assets/js/form.js'></script>
<div id="form-row" class="row">
    <div class="row-content">
        <div class="nav-content">
            <div class="nav">
                <a id="login-button login-content" class="nav-form-button active">
                    <span class="text active">Connexion</span>
                    <span class="icon"><i class="fas fa-unlock"></i></span>
                </a>
                <a id="register-button register-content" class="nav-form-button">
                    <span class="text active">Inscription</span>
                    <span class="icon"><i class="fas fa-edit"></i></span>
                </a>
                <a id="reset-button reset-content" class="nav-form-button">
                    <span class="text active">Réinitialiser</span>
                    <span class="icon"><i class="fas fa-sync-alt"></i></span>
                </a>
            </div>
        </div>
        <div id="login-content" class="form-content content content-login active">
            <h2 class="title">Veuillez vous identifier</h2>
            <form method="POST" action="/user/login">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="text" name="username" id="username" class="form-control" placeholder="Nom d'utilisateur" required="" autofocus="">
                <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required="">
                <input class="button black" name="login" value="Connexion" type="submit">
            </form>
        </div>

        <div id="register-content" class="form-content content content-register">
            <h2 class="title">Veuillez vous enregistrer</h2>
            <form method="POST" action="/user/register">
                <input type="hidden" name="token" value="<?= $token ?>">
                <div class="inline-flex">
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Nom"  required="">
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Prénom" autofocus="" required="">
                </div>
                <input type="email" name="mail" id="mail" class="form-control" placeholder="Adresse mail" required="">
                <input type="text" name="username" id="username" class="form-control" placeholder="Nom d'utilisateur" required="">
                <div class="inline-flex">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe *" required="">
                    <input type="password" name="password_repeat" id="password_repeat" class="form-control" placeholder="Répéter mot de passe *" required="">
                </div>
                <input class="button black" name="register" value="Inscription" type="submit">
            </form>
            <div class="infos">
                * : 8 caractères dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.
            </div>
        </div>

        <div id="reset-content" class="form-content content content-reset">
            <h2 class="title">Veuillez indiquer votre adresse</h2>
            <form method="POST" action="/user/resetpw_ask">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="email" name="mail" id="mail" class="form-control" placeholder="Adresse mail" required="" autofocus="">
                <input class="button black" name="reset" value="Réinitialiser" type="submit">
            </form>
        </div>
    </div>
</div>