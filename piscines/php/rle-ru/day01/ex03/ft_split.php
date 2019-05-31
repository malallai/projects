#!/usr/bin/php
<?php
function ft_split($str)
{
	$a = preg_split('/ +/', $str, -1,PREG_SPLIT_NO_EMPTY);
	foreach($a as $key=>$b)
		$a[$key] = trim($a[$key]);
	return ($a);
}
?>
