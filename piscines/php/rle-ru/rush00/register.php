<?php
include('assets/templates/header.php');

    if (isset($_POST['create'])) {
        $new = array();
        $new['login'] = $_POST['login'];
        $new['pass'] = hash('whirlpool', $_POST['pass']);
        $new['grade'] = ($_POST['login'] == "rle-ru" || $_POST['login'] == "malallai") ? "admin" : "customer";
        if (create_user($new) !== true) {
            ?>
            <p>User already exists</p>
            <?php
        } else {
            header("location: login.php");
        }
    }

?>
<link rel="stylesheet" href="assets/css/login.css">
<div class="container">
    <div class="log-top">
        <a class="login" href="login.php">Connexion</a>
        <a class="active register"href="register.php">Inscription</a>
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

<?php
include ('assets/templates/footer.php');
?>
