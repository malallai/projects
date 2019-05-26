<?php
include('assets/templates/header.php');
?>
<div class="flex-items">
    <div class="item">
        <div class="image">
            <img src="https://cdn.intra.42.fr/users/bclerc.jpg">
        </div>
        <div class="description">
            <div class="name">
                <p>bclerc</p>
            </div>
            <div class="price">Prix : 10E</div>
            <div class="quantity">Annee : 2018</div>
            <form action="additem.php" method="post">
                <input class="id" name="id" type="text" value="0">
                <input class="submit" name="submit" type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
    <?php
	$file = unserialize(file_get_contents("../private/products"));
	$page = $_GET['page'] != NULL ? $_GET['page'] : 0;

    if ($file)
    {
		$i = $page * 5;
        foreach($file as $k=>$f)
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
                    <div class="quantity">Annee : <?= $f['year'] ?></div>
                    <form action="additem.php" method="post">
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
		if (count($file) > $i + 5)
		echo "<a href=\"index.php?page=", $page + 1 , "\">Page suivante</a>";
    }
    ?>
</div>
<?php
include('assets/templates/footer.php');
?>