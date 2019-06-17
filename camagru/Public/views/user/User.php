<link href="/Public/assets/css/login.css" rel="stylesheet">
<script src='/Public/assets/js/user_login.js'></script>
<div class="row">
    <div class="row-content">
        <div class="nav-content">
            <div class="nav">
                <a id="login-button" class="active nav-big">Connexion</a>
                <a id="register-button" class="nav-big">Inscription</a>
                <a id="reset-button" class="nav-big">Réinitialiser</a>
                <a id="login-small-button" class="active nav-small"><i class="fas fa-unlock"></i></a>
                <a id="register-small-button" class="nav-small"><i class="fas fa-pen"></i></a>
                <a id="reset-small-button" class="nav-small"><i class="fas fa-lock"></i></a>
            </div>
        </div>
        <div  id="login-content" class="content content-login active">
            <h2 class="title">Veuillez vous identifier</h2>
            <form method="POST" action="/user/login">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="text" name="username" id="username" class="form-control" placeholder="Nom d'utilisateur" required="" autofocus="">
                <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required="">
                <input classu="button black" name="login" value="Connexion" type="submit">
            </form>
        </div>

        <div  id="register-content" class="content content-register">
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
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" required="">
                    <input type="password" name="password_repeat" id="password_repeat" class="form-control" placeholder="Répéter mot de passe" required="">
                </div>
                <input class="button black" name="register" value="Inscription" type="submit">
            </form>
        </div>

        <div  id="reset-content" class="content content-reset">
            <h2 class="title">Veuillez indiquer votre adresse</h2>
            <form method="POST" action="/user/resetpw">
                <input type="hidden" name="token" value="<?= $token ?>">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required="" autofocus="">
                <input class="button black" name="reset" value="Réinitialiser" type="submit">
            </form>
        </div>
    </div>
</div>