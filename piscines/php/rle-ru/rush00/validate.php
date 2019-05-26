<?php
session_start();
include("install.php");
install();
$file = unserialize(file_get_contents("../private/orders"));
$n = rand(0, 100000);
$file[$n] = $_SESSION['items'];
file_put_contents("../private/orders", serialize($file));
unset($_SESSION['items']);
$_SESSION['items_count']=0;
$file = unserialize(file_get_contents("../private/accounts"));
foreach ($file as $k=>$f)
	if ($f['name'] == $_SESSION['logged_as'])
		break;
$file[$k]['orders'][] = $n;
file_put_contents("../private/accounts", serialize($file));
header("location: cart.php");
?>
