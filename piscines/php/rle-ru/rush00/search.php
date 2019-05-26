<?php
include('templates/header.php');
include("install.php");
install();
?>
<div class="flex-items">
<?php
if ($_POST['search'])
{
	$res = array();
	$file = unserialize(file_get_contents("../private/products"));
	foreach ($file as $f)
	{
		if ($f['name'] == $_POST['search'] || $f['year'] == $_POST['search'])
			$res[] = $f;
	}
	$page = $_GET['page'] != NULL ? $_GET['page'] : 0;
	$i = $page * 5;
	foreach($res as $k=>$f)
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
		if (count($res) > $i + 5)
		echo "<a href=\"index.php?page=", $page + 1 , "\">Page suivante</a>";
}
?></div>
<?php
include('templates/footer.php');
?>
