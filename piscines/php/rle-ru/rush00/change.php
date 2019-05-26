<?php
session_start();
include('install.php');
install();
if (!($file = unserialize(file_get_contents("../private/accounts"))))
{
	header("location: user.php");
	return ;
}
foreach ($file as $k=>$f)
{
	if ($f['login'] == $_SESSION['logged_as'])
	{
		if (hash('whirlpool', $_POST['oldpw']) == $f['pass'])
		{
			$f['pass'] = hash('whirlpool', $_POST['newpw']);
			$file[$k] = $f;
			file_put_contents("../private/accounts", $file);
			break ;
		}
		else
			header("location: user.php?msg=wrondpw");
	}
}
header("location: user.php?msg=passchangesuccess");
