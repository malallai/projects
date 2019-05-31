<?php
date_default_timezone_set('Europe/Paris');
session_start();
if (!($_SESSION['loggued_on_user']))
	echo "ERROR\n";
else
{
	if (file_exists("../private") && file_exists("../private/chat"))
	{
		$file = unserialize(file_get_contents('../private/chat'));
		foreach ($file as $line)
			echo "[", date("H:i", $line['time']), "] ", $line['login'], " : ", $line['msg'], "<br />";
	}
}
?>
