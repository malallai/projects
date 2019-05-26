<?php
session_start();
include('install.php');
install();
if ($_POST['name'])
	$todel = $_POST['name'];
else
	$todel = $_SESSION['logged_as'];
if (!($file = unserialize(file_get_contents("../private/accounts"))))
{
	header("location: user.php");
	return ;
}
foreach ($file as $k=>$f)
{
	if ($f['login'] == $todel)
	{
		if (hash('whirlpool', $_POST['pass']) == $f['pass'] || $_SESSION['grade'] == 'admin')
		{
			unset($file[$k]);
			file_put_contents("../private/accounts", $file);
			break ;
		}
		else
			header("location: user.php?msg=wrondpw");
	}
}
header("location: user.php?msg=accountdeleted");
?>
