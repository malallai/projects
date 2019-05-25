<?php
session_start();
if (file_exists("../private") && file_exists("../private/accounts"))
{
	$file = unserialize(file_get_contents("../private/accounts"));
	foreach($file as $f)
	{
		if ($f['login'] == $_POST['login'])
		{
			if ($f['pass'] == hash('whirlpool', $_POST['pass']))
			{
				$_SESSION['logged_as'] = $_POST['login'];
				header("location: index.php");
				return ;
			}
			else
			{
				echo "Wrong password\n";
				return ;
			}	
		}
	}
}
?>
