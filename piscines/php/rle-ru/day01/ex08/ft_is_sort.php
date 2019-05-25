#!/usr/bin/php
<?php
function ft_is_sort($input)
{
	$sorted = array_values($input);
	sort($sorted);
	if ($input == $sorted)
		return (true);
	else
		return (false);
}
?>
