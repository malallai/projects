#!/usr/bin/php
<?php
foreach($argv as $key=>$arg)
{
	if ($key < 2)
		continue ;
	$s = preg_split('/:/', $argv[$key], 2, PREG_SPLIT_NO_EMPTY);
	if ($s[0] == $argv[1])
		$word = $s[1];
}
if (isset($word))
	echo"$word\n";
?>
