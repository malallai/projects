#!/usr/bin/php
<?php
function weight($c)
{
	if (ctype_alpha($c))
		return (ord($c));
	else if (ctype_digit($c))
		return (ord($c) + 255);
	else
		return (ord($c) + 510);
}

function ssap($s1, $s2)
{
	$s1 = strtolower($s1);
	$s2 = strtolower($s2);
	foreach(str_split($s1) as $c1)
		foreach(str_split($s2) as $c2)
			if ($c1 != $c2)
				return (weight($c1) - weight($c2));
	return (strlen($c1) - strlen($c2));
}


if ($argc > 1){
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
	usort($c, ssap);
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
