#!/usr/bin/php
<?php
if(!file_exists("/var/run/utmpx") || ($fid = fopen("/var/run/utmpx", 'r')) == FALSE)
    return;
$buffer = fread($fid, 1256);
date_default_timezone_set('Europe/Paris');
$datas = array();
while ($buffer = fread($fid, 628))
    $datas[] = unpack("a256user/a4postname/a32name/ipid/itype/I1time", $buffer);
usort($datas, function($a, $b) {
        return $a['name'] > $b['name'];
});
foreach ($datas as $data)
    if ($data['type'] == 7)
		printf("%-8s %s  %s \n", trim($data['user'], "\0"), trim($data['name'], "\0"), date("M d H:i", $data['time']));
?>
