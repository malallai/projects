<?php
include('assets/templates/header.php');

    if (isset($_POST['create'])) {
        $new = array();
        $new['login'] = $_POST['login'];
        $new['pass'] = hash('whirlpool', $_POST['pass']);
        $new['name'] = $_POST['name'];
        $new['grade'] = ($_POST['login'] == "rle-ru" || $_POST['login'] == "malallai") ? "admin" : "customer";
        $new['img'] = "https://cdn.intra.42.fr/users/".$new['login'].".jpg";
        if (create_user($new) !== true) {
            ?>
            <p>User already exists</p>
            <?php
        }
    }

?>
<link rel="stylesheet" href="assets/css/install.css">
<div class="container">
    <div class="install-row">
        <div class="install-content">
            <p>Création d'un compte</p>
            <div class="install">
                <form method="POST" action="register.php">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Nom d'utilisateur">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">
                    <input class="btn btn-white" name="create" value="Créer" type="submit">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include ('assets/templates/footer.php');
?>
