<link href="/assets/css/login.css" rel="stylesheet">
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
            <form method="POST" action="">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required="" autofocus="">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="">
                <input class="button black" name="login" value="Connexion" type="submit">
            </form>
        </div>

        <div  id="register-content" class="content content-register">
            <h2 class="title">Veuillez vous enregistrer</h2>
            <form method="POST" action="">
                <div class="inline-flex">
                    <input type="text" name="name" id="inputName" class="form-control" placeholder="Nom complet" autofocus="">
                    <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Nom d'utilisateur *" required="">
                </div>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse mail *" required="">
                <div class="inline-flex">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe *" required="">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Répéter mot de passe *" required="">
                </div>
                <input class="button black" name="login" value="Inscription" type="submit">
            </form>
            <p class="infos">Les champs suivis d'une étoile * sont obligatoires.</p>
        </div>

        <div  id="reset-content" class="content content-reset">
            <h2 class="title">Veuillez indiquer votre adresse</h2>
            <form method="POST" action="">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required="" autofocus="">
                <input class="button black" name="login" value="Réinitialiser" type="submit">
            </form>
        </div>
    </div>
</div>