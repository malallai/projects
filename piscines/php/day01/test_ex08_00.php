<?php
function print_array($tab)
{
	foreach($tab as $elem)
		echo "$elem\n";
}
$tab = array();
if ($argc > 1)
{
	include("ex08/ft_is_sort.php");
	$i = 1;
	while ($argv[$i])
	{
		$tab[$i - 1] = $argv[$i];
		$i++;
	}
}
// print_array($tab);
if (ft_is_sort($tab))
	echo "The array is sorted\n";
else
	echo "The array is not sorted\n";
// sort($tab);
// print_array($tab);
?>
