#!/usr/bin/php
<?php
if ($argc != 2)
{
	echo"Incorrect Parameters\n";
	exit();
}
$s = trim($argv[1]);
if (!preg_match("/^([+-]?\d+) *([\+\-\*\%\/]) *([+-]?\d+)$/", $s, $b))
{
	echo"Syntax Error\n";
	exit();
}
if (count($b) != 4)
{
	echo"Syntax Error\n";
	return ;
}
if (($b[2] == "/" || $b[2] == "%") && $b[3] == 0)
{
	echo"Syntax Error\n";
	exit();
}
switch ($b[2])
{
	case "+":
		$res = $b[1] + $b[3];
		break;
	case "-":
		$res = $b[1] - $b[3];
		break;
	case "*":
		$res = $b[1] * $b[3];
		break;
	case "/":
		$res = $b[1] / $b[3];
		break;
	case "%":
		$res = $b[1] % $b[3];
		break;
}

echo"$res\n";
?>
