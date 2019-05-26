<?php
include('assets/templates/header.php');

if (isset($_POST['submit'])) {
    add_item_to_cart($_POST['id']);
    header("location: index.php");
}

if (is_installed() !== true) {
    header("location: install.php");
}
?>
<div class="flex-items">

    <?php
    $products = get_products();

    if ($_GET['search'])
    {
        $products = search_item_by_name($_GET['search']);
    }

    foreach ($_GET as $key => $val) {
        if (get_categories()[$key]) {
            $products = search_item_by_categories($products, $val[0]);
        }
    }
	$page = isset($_GET['page']) && $_GET['page'] != NULL ? $_GET['page'] : 0;

    if ($products)
    {
		$i = $page * 5;
        foreach($products as $k=>$f)
        {
			if ($k >= $i && $k < $i + 5)
			{
            ?>
            <div class="item">
                <div class="image">
                    <img src="https://cdn.intra.42.fr/users/<?= $f['name'] ?>.jpg">
                </div>
                <div class="description">
                    <div class="name">
                        <p><?= $f['name'] ?></p>
                    </div>
                    <div class="price">Prix : <?= $f['price'] ?>E</div>
                    <div class="quantity">Annee : <?= $f['categories']['year'] ?></div>
                    <div class="quantity">Campus : <?= $f['categories']['campus'] ?></div>
                    <form action="index.php" method="post">
                        <input class="id" name="id" type="text" value="<?= $f['uid'] ?>">
                        <input class="submit" name="submit" type="submit" value="Ajouter au panier">
                    </form>
                </div>
            </div>
			<?php
			}
		}
		if ($page > 0)
			echo "<a href=\"index.php?page=", $page - 1 , "\">Page precedente</a>";
		if (count($products) > $i + 5)
		    echo "<a href=\"index.php?page=", $page + 1 , "\">Page suivante</a>";
    }
    ?>
</div>
<?php
include('assets/templates/footer.php');
?>