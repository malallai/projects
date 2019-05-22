#!/usr/bin/php
<?php
	function ft_split($string) {
		$array = array_filter(explode(' ', $string));
		return ($array);
	}

	$array = array_values(ft_split($argv[1]));
	$array[count($array)] = $array[0];
	unset($array[0]);

	$final = "";
	if ($array) {
    	foreach ($array as $value)
    		$final .= $value." ";
	    echo trim($final)."\n";
    }