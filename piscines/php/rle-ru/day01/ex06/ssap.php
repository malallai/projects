#!/usr/bin/php
<?php
if ($argc > 1)
{
	$i = 1;
	$c = array();
	while ($i < $argc)
	{
		$a = preg_split('/ +/', $argv[$i], -1,PREG_SPLIT_NO_EMPTY);
		foreach($a as $key=>$b)
			$a[$key] = trim($a[$key]);
		$c = array_merge($c, $a);
		$i++;
	}
	asort($c);
	$s = 0;
	foreach($c as $key=>$e)
	{
		if ($s == 0)
			$s =1;
		else
			echo "\n";
		$c[$key] = trim($c[$key]);
		echo"$c[$key]";
	}
	echo"\n";
}
?>
