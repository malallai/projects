#!/usr/bin/php
<?php

while (1)
{
	echo"Entrez un nombre: ";
	if (($str = fgets(STDIN)) === FALSE)
		break ;
	$n = trim($str);
	if (is_numeric($n))
	{
		if ($n & 1)
			echo"Le chiffre $n est Impair\n";
		else
			echo"Le chiffre $n est Pair\n";
	}
	else
		echo"'$n' n'est pas un chiffre\n";
}
echo "\n";
fclose($fd);
?>
