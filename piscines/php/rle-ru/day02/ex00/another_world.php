#!/usr/bin/php
<?php
if ($argc == 1)
	return ;
echo preg_replace("/[ \t]{1,}/", " ", trim($argv[1])), "\n";
?>
