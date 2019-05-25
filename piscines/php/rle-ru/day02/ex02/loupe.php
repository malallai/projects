#!/usr/bin/php
<?php

function	ft_reg($mat)
{
	$mat[0] = preg_replace_callback(
		"/( title=\")(.*?)(\")/mi",
		function($mat){ return ($mat[1].strtoupper($mat[2]).$mat[3]);},
		$mat[0]);
	$mat[0] = preg_replace_callback(
		"/(>)(.*?)(<)/si",
		function($mat){ return ($mat[1].strtoupper($mat[2]).$mat[3]);},
		$mat[0]);
	return ($mat[0]);
}

if ($argc < 2 || file_exists($argv[1]) == FALSE)
	return ;
if (($file = file_get_contents($argv[1])) === FALSE)
	return ;
$file = preg_replace_callback(
	"/(<a)(.*?)(>)(.*)(<\/a>)/si",
	ft_reg,
	$file);
echo $file, "\n";
?>
