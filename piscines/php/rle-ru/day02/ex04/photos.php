#!/usr/bin/php
<?php
if ($argc < 2)
	return ;
$ch = curl_init($argv[1]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$page = curl_exec($ch);
curl_close($ch);
if (empty($page))
	return ;
preg_match_all("/<img[^>]+src=([^\s>]+)/si", $page, $mat);
foreach($mat[1] as $key => $m)
{
	$mat[1][$key] = trim($m, "\"");
	if (preg_match("/^http(s?):\/\//", $mat[1][$key]) == FALSE)
	{
		if (preg_match("/^\//", $mat[1][$key]))
		{
			preg_match("/^(http(s?):\/\/)([^\/]+)/", $argv[1], $umat);
			$mat[1][$key] = $umat[1] . $umat[3] . $mat[1][$key];
		}
		else
			$mat[1][$key] = $argv[1] . $mat[1][$key];
	}
}
$img = $mat[1];
$rep = preg_replace("/^.+?:\/\//", "", $argv[1]);
if (!file_exists($rep) || !is_dir($rep))
	mkdir($rep);
foreach($img as $i)
{
	if (preg_match("/^\/.+/", $i))
		$i = $argv[1] . $i;
	$ch = curl_init($i);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	$data = curl_exec($ch);
	curl_close($ch);
	preg_match("/^.+?([^\/]+)$/", $i, $mat);
	if (substr($mat[1], -1) === "\"" || substr($mat[1], -1) === "'")
		$name = substr($mat[1], 0, -1);
	else
		$name = $mat[1];
	file_put_contents($rep."/".$name, $data);
}
?>
