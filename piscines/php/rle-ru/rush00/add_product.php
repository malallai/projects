<?php

if (!file_exists("../private") || !file_exists("../private/products"))
	return ;
$file = unserialize(file_get_contents("../private/products"));
if ($_POST['name'] && $_POST['price'])
{
	$new['name'] = $_POST['name'];
	$new['price'] = $_POST['price'];
	$new['img'] = "https://cdn.intra.42.fr/users/" . $new['name'] . ".jpg";
	$new['uid'] = rand(0, 100000);
	$new['year'] = $_POST['year'];
	$file[] =  $new;
	file_put_contents("../private/products", serialize($file));
}
header("Location: admin.php");
?>
