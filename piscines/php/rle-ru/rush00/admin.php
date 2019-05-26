<?php
include('assets/templates/header.php');
if ($_SESSION['grade'] != 'admin')
{
    ?>
    <div class="shall-not-pass">
        <?php
        $search = "You shall not pass";
        $url = "http://api.giphy.com/v1/gifs/search?q=".rawurlencode($search)."&api_key=ppHGDwDLRKMbmaBQFiWLTUneoMG1oa3F";
        $data = json_decode(file_get_contents($url), true);
        $id = rand(0, $data['pagination']['count']);
        $image = $data['data'][$id]['images']['original']['url'];
        ?>
        <img src="<?= $image ?>" />
    </div>
    <?php
}
else
{
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] === "Ajouter un produit") {
            $new = array();
            $new['name'] = $_POST['name'];
            $new['price'] = $_POST['price'];
            $new['uid'] = rand(0, 100000);
            $new['categories']['annee'] = $_POST['annee'];
            $new['categories']['campus'] = $_POST['campus'];
            create_product($new);
        } else if ($_POST['submit'] === "Supprimer un produit") {
            delete_product(get_product_uid($_POST['name']));
        } else if ($_POST['submit'] === "Supprimer un utilisateur") {
            delete_user($_POST['name']);
        } else if ($_POST['submit'] === "Ajouter une catégorie") {
            create_category($_POST['name']);
        } else if ($_POST['submit'] === "Supprimer une catégorie") {
            delete_category($_POST['name']);
        } else if ($_POST['submit'] === "Ajouter un item à la catégorie") {
            add_item_category($_POST['name'], $_POST['item']);
        } else if ($_POST['submit'] === "Supprimer un item de la catégorie") {
            delete_item_category($_POST['name'], $_POST['item']);
        } else if ($_POST['submit'] === "Ajouter une catégorie au produit") {
            add_cat_to_product($_POST['name'], $_POST['category'], $_POST['item']);
        } else if ($_POST['submit'] === "Retirer une catégorie au produit") {
            remove_cat_from_product($_POST['name'], $_POST['category']);
        }
        header("Location: admin.php");
    }

    ?>
    <form method="POST" action="admin.php">
        <span>Ajouter un produit: </span>
        <input type="text" name="name">
        <span>Prix: </span>
        <input type="text" name="price">
        <span>Année: </span>
        <input type="text" name="annee">
        <span>Campus: </span>
        <input type="text" name="campus">
        <input type="submit" name="submit" value="Ajouter un produit">
    </form>
    <form method="POST" action="admin.php">
        <span>Supprimer un produit: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Supprimer un produit">
    </form>
    </br>
    <form method="POST" action="admin.php">
        <span>Ajouter une catégorie: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Ajouter une catégorie">
    </form>
    <form method="POST" action="admin.php">
        <span>Supprimer une catégorie: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Supprimer une catégorie">
    </form>
    </br>
    <form method="POST" action="admin.php">
        <span>Ajouter un item à la catégorie: </span>
        <input type="text" name="name">
        <span>Item: </span>
        <input type="text" name="item">
        <input type="submit" name="submit" value="Ajouter un item à la catégorie">
    </form>
    <form method="POST" action="admin.php">
        <span>Supprimer un item de la catégorie: </span>
        <input type="text" name="name">
        <span>Item: </span>
        <input type="text" name="item">
        <input type="submit" name="submit" value="Supprimer un item de la catégorie">
    </form>
    </br>
    <form method="POST" action="admin.php">
        <span>Ajouter une catégorie au produit: </span>
        <input type="text" name="name">
        <input type="text" name="category">
        <input type="text" name="item">
        <input type="submit" name="submit" value="Ajouter une catégorie au produit">
    </form>
    <form method="POST" action="admin.php">
        <span>Retirer une catégorie au produit: </span>
        <input type="text" name="name">
        <input type="text" name="category">
        <input type="submit" name="submit" value="Retirer une catégorie au produit">
    </form>
    </br>
    <form method="POST" action="admin.php">
        <span>Supprimer un utilisateur: </span>
        <input type="text" name="name">
        <input type="submit" name="submit" value="Supprimer un utilisateur">
    </form>
    </br>
    <a href='admin_orders.php'>Historique des commandes</a>
    <?php
}
include('assets/templates/footer.php');
?>
