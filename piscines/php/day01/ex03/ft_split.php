#!/usr/bin/php
<?php
	function ft_split($string) {
		$array = array_filter(explode(' ', $string));
		sort($array);
		return ($array);
	}
