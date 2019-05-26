<?php

    include ('assets/templates/header.php');
    include ('api/minishop.php');

    if (isset($_POST['action']) && $_POST['action'] === "install") {
        if (!file_exists("../private"))
            mkdir("../private");
        if (!file_exists("../private/accounts"))
        {
            $file = init_accounts($_POST['uername'], $_POST['password']);
            file_put_contents("../private/accounts", serialize($file));
        }
        if (!file_exists("../private/products"))
        {
            $file = init_products();
            file_put_contents("../private/products", serialize($file));
        }
        if (!file_exists("../private/orders"))
            file_put_contents("../private/orders", NULL);
        header('location: index.php');
    }

    function init_accounts($login, $password)
    {
        $file = array();
        $file[] = array("login"=>$login, "pass"=>hash('whirlpool', $password), "grade"=>"admin");
        $file[] = array("login"=>"rle-ru", "pass"=>hash('whirlpool', "pass"), "grade"=>"admin");
        $file[] = array("login"=>"malallai", "pass"=>hash('whirlpool', "pass"), "grade"=>"admin");
        return ($file);
    }

    function	init_products()
    {
        $file = array();
        $file[] = array("name"=>"llelievr", "uid"=>rand(0, 100000), "year"=>"2018", "price"=>"0.01");
        $file[] = array("name"=>"sadahan", "uid"=>rand(0, 100000), "year"=>"2018", "price"=>"4.68");
        $file[] = array("name"=>"dde-jesu", "uid"=>rand(0, 100000), "year"=>"2018", "price"=>"8.83");
        $file[] = array("name"=>"fcazier", "uid"=>rand(0, 100000), "year"=>"2018", "price"=>"5.33");
        $file[] = array("name"=>"ephe", "uid"=>rand(0, 100000), "year"=>"2018", "price"=>"5");
        $file[] = array("name"=>"bwaterlo", "uid"=>rand(0, 100000), "year"=>"2018", "price"=>"6.36");
        $file[] = array("name"=>"yhemme", "uid"=>rand(0, 100000), "year"=>"2017", "price"=>"11.82");
        $file[] = array("name"=>"mimhoff", "uid"=>rand(0, 100000), "year"=>"2017", "price"=>"10.48");
        $file[] = array("name"=>"dgalanop", "uid"=>rand(0, 100000), "year"=>"2019", "price"=>"0.22");
        return ($file);
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
