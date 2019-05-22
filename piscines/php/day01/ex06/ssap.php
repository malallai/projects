#!/usr/bin/php
<?php
	function ft_split($string) {
		$array = array_filter(explode(' ', $string));
		return ($array);
	}

	$array = array();
	$i = 1;
	while ($i < $argc) {
	    $array = array_merge($array, ft_split($argv[$i]));
        $i++;
	}
	sort($array);
	foreach ($array as $value)
		print $value."\n";
