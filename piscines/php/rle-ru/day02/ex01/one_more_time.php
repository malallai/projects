#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
if ($argc < 2)
	return ;
$date = explode(" ", $argv[1]);
if (count($date) != 5)
{
	echo "Wrong Format\n";
	return ;
}
$day = array(
	1 => "lundi",
	2 => "mardi",
	3 =>"mercredi",
	4 => "jeudi",
	5 => "vendredi",
	6 => "samedi",
	7 => "dimanche"
);
$month = array(
	1 => "janvier",
	2 => "fevrier",
	3 => "mars",
	4 => "avril",
	5 => "mai",
	6 => "juin",
	7 => "juillet",
	8 => "août",
	9 => "septembre",
	10 => "octobre",
	11 => "novembre",
	12 => "decembre"
);
if (($date[0] = array_search(lcfirst($date[0]), $day)) == FALSE)
{
	echo "Wrong Format\n";
	return ;
}
if (($date[2] = array_search(lcfirst($date[2]), $month)) == FALSE)
{
	echo "Wrong Format\n";
	return ;
}
if (preg_match("/^([1-9]|0[1-9]|[1-2]\d|3[0-1])$/", $date[1]) == FALSE)
{
	echo "Wrong Format\n";
	return ;
}
if (preg_match("/\d{4}/", $date[3]) == FALSE)
{
	echo "Wrong Format\n";
	return ;
}
if (preg_match("/^([0-2]\d):([0-5][0-9]):([0-5][0-9])$/", $date[4]) == FALSE)
{
	echo "Wrong Format\n";
	return ;
}
$date[4] = explode(":", $date[4]);
$time = mktime($date[4][0], $date[4][1], $date[4][2], $date[2], $date[1], $date[3]);
if (date("N", $time) == $date[0])
	echo "$time", "\n";
else
	echo "Wrong Format\n";
?>
