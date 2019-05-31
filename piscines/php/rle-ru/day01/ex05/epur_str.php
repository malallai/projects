#!/usr/bin/php
<?php
if ($argc == 2)
{
	$a = preg_split('/ +/', $argv[1], -1,PREG_SPLIT_NO_EMPTY);
	$s = 0;
	foreach($a as $key=>$b)
	{
		if ($s == 0)
			$s =1;
		else
			echo " ";
		$a[$key] = trim($a[$key]);
		echo"$a[$key]";
	}
	echo "\n";
}
?>
