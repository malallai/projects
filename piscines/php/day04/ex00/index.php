<?php
    session_start();
    if (isset($_GET) && isset($_GET['submit']) && isset($_GET['login']) && isset($_GET['password'])) {
        if ($_GET['submit'] === "OK") {
            $_SESSION['login'] = $_GET['login'];
            $_SESSION['password'] = $_GET['password'];
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ex00: session</title>
    </head>
    <body>
        <form action="." method="get">
            Identifiant: <input type="text" name="login" value="<?=$_SESSION['login']?>">
            <br>
            Mot de passe: <input type="password" name="password" value="<?=$_SESSION['password']?>">
            <br>
            <input type="submit" name="submit" value="OK">
        </form>
    </body>
</html>