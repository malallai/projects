<?php
include('templates/header.php');
?>
<div class="flex-items">
    <div class="item">
        <div class="image">
            <img src="https://cdn.intra.42.fr/users/malallai.jpg">
        </div>
        <div class="description">
            <div class="name">
                <p>nom</p>
            </div>
            <div class="price">Prix : x</div>
            <div class="quantity">Quantité : x</div>
            <form action="additem.php" method="post">
                <input class="id" name="id" type="text" value="1">
                <input class="submit" name="submit" type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
    <div class="item">
        <div class="image">
            <img src="https://cdn.intra.42.fr/users/malallai.jpg">
        </div>
        <div class="description">
            <div class="name">
                <p>nom</p>
            </div>
            <div class="price">Prix : x</div>
            <div class="quantity">Quantité : x</div>
            <form action="additem.php" method="post">
                <input class="id" name="id" type="text" value="1">
                <input class="submit" name="submit" type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
    <div class="item">
        <div class="image">
            <img src="https://cdn.intra.42.fr/users/malallai.jpg">
        </div>
        <div class="description">
            <div class="name">
                <p>nom</p>
            </div>
            <div class="price">Prix : x</div>
            <div class="quantity">Quantité : x</div>
            <form action="additem.php" method="post">
                <input class="id" name="id" type="text" value="1">
                <input class="submit" name="submit" type="submit" value="Ajouter au panier">
            </form>
        </div>
    </div>
<html>
<head>
	<link href="body.css" type="text/css" rel="stylesheet" />
	<title>42Shop - Home</title>
</head>
<body>
<div id="main">
	<?php
	$file = unserialize(file_get_contents("../private/products"));
	if ($file)
	{
		foreach($file as $f)
		{
			?>
			<img class="thu" src="<?php echo "https://cdn.intra.42.fr/users/".$f['name'].".jpg"?>" />
			<?php
		}
	}
	?>
</div>
<?php
include('templates/footer.php');
?>