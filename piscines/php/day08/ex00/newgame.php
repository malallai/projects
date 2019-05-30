<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Game | D08</title>
    <link rel="stylesheet" href="assets/css/newgame.css">
</head>
<body>
<div class="background"></div>
<div class="container">
    <div class="log-top-row">
        <div class="log-top-content">
            <div class="log-top">
                <a class="active" href="login.php">Connexion</a>
                <a class="" href="register.php">Inscription</a>
            </div>
        </div>
    </div>

    <div class="login-row">
        <div class="login-content">
            <p>Connexion</p>
            <div class="login">
                <form method="POST" action="login.php">
                    <input type="text" name="login" id="login" class="form-control" placeholder="Login">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">
                    <input class="btn btn-white" name="log" value="Connexion" type="submit">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
