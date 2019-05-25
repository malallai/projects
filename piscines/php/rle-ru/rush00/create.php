<?php
include('header.php');
session_start();
if (!$_POST['login'] || !$_POST['pass'] || !$_POST['name'])
{
	echo "Incomplete fields\n";
	;
}
else if (file_exists("../private") && file_exists("../private/accounts"))
{
	$file = unserialize(file_get_contents("../private/accounts"));
	foreach($file as $f)
	{
		if ($f['login'] == $_POST['login'])
		{
			echo "User already exists\n";
			return ;
		}
	}
	$new['login'] = $_POST['login'];
	$new['pass'] = hash('whirlpool', $_POST['pass']);
	$new['name'] = $_POST['name'];
	$new['grade'] = ($_POST['name'] == "rle-ru" || $_POST['name'] == "malallai") ? "admin" : "customer";
	$new['img'] = "https://cdn.intra.42.fr/users/".$new['login'].".jpg";
	$file[] = $new;
	file_put_contents("../private/accounts", serialize($file));
}
?>
<html>
<head>
	<link href="body.css" type="text/css" rel="stylesheet" />
	<meta charset="utf/8" />
	<title>42Shop - Create account</title>
</head>
<body>
<div id="main">
<form method="POST" action="create.php">
<span class="fields">Login: </span><input type="text" name="login" />
<span class="fields">Password: </span><input type="password" name="pass" />
<span class="fields">Name: </span><input type="text" name="name" />
<input type="submit" name="submit" value="Register">
</form>
</div>
</body>
</html>
