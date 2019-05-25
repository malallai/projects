#!/usr/bin/php
<?php
if ($argc != 4)
{
	echo"Incorrect Parameters\n";
	exit();
}
$op = trim($argv[2], " \t");
switch ($op)
{
	case "+":
		$r = trim($argv[1], " \t") + trim($argv[3], " \t");
		echo"$r\n";
		break;
	case "-":
		$r = trim($argv[1], " \t") - trim($argv[3], " \t");
		echo"$r\n";
		break;
	case "*":
		$r = trim($argv[1], " \t") * trim($argv[3], " \t");
		echo"$r\n";
		break;
	case "/":
		$r = trim($argv[1], " \t") / trim($argv[3], " \t");
		echo"$r\n";
		break;
	case "%":
		$r = trim($argv[1], " \t") % trim($argv[3], " \t");
		echo"$r\n";
		break;
}
?>
