<?php

    include ('assets/templates/header.php');
    include ('api/minishop.php');

    if (isset($_POST['action']) && $_POST['action'] === "install") {
        mkdir("private");
        file_put_contents("../private/accounts", NULL);
        file_put_contents("../private/products", NULL);
        file_put_contents("../private/orders", NULL);

    }

?>
<link rel="stylesheet" href="assets/css/install.css">
<div class="container">
    <div class="install-row">
        <div class="install-content">
            <p>Création du profile administrateur</p>
            <div class="install">
                <form method="POST" action="install.php">
                    <input type="text" name="username" id="username" class="form-control" placeholder="Nom d'utilisateur">
                    <input type="email" name="email" id="mail" class="form-control" placeholder="Adresse Email">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe">
                    <input type="password" name="repeat" id="repeatPass" class="form-control" placeholder="Répéter le mot de passe">
                    <input class="btn btn-green" name="create" value="Créer" type="submit">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include ('assets/templates/footer.php');
?>
