<?php
if (!file_exists("../private") || !file_exists("../private/products"))
	return ;
$file = unserialize(file_get_contents("../private/products"));
if ($_POST['name'])
{
	foreach($file as $k=>$f)
	{
		if ($f['login'] == $_POST['name'])
			break;
	}
	unset($file[$k]);
	file_put_contents("../private/products", serialize($file));
}
header("Location: admin.php");
?>
