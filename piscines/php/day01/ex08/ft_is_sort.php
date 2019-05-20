#!/usr/bin/php
<?php
	function ft_is_sort($array) {
		$array_sort = $array;
		sort($array_sort);
		if (array_diff_assoc($array, $array_sort) == null)
			return true;
		return false;
	}

