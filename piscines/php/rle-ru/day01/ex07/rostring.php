#!/usr/bin/php
<?php
if ($argc > 1)
{
	$a = preg_split('/ +/', $argv[1], -1,PREG_SPLIT_NO_EMPTY);
	$s = 0;
	foreach($a as $key=>$b)
	{
		if ($s <= 1)
			$s++;
		else
			echo " ";
		$a[$key] = trim($a[$key]);
		if ($key > 0)
			echo"$a[$key]";
	}
	if ($s > 1)
		echo" ";
	echo"$a[0]\n";
}
?>
