#!/usr/bin/php
<?php
    /**
     * https://www.w3schools.com/php/func_misc_unpack.asp
     * https://github.com/libyal/dtformats/blob/master/documentation/Utmp%20login%20records%20format.asciidoc#32-record
     */

    date_default_timezone_set("CET");
    $file_content = file_get_contents("/var/run/utmpx");
    $format = 'a256user/a4id/a32device/ipid/itype/Itime';
    $unpack = array();
    $users = array();
    $file_content = substr($file_content, 1256);
    while ($file_content != null) {
        $unpack = unpack($format, $file_content);
        if ($unpack[type] === 7) {
            $time = date("M d H:i", $unpack[time]);
            $users[] = $unpack[user]." ".$unpack[device]."  ".$time;
        }
        $file_content = substr($file_content, 628);
    }
    if ($users) {
        sort($users);
        foreach ($users as $user) {
            print $user . "\n";
        }
    }
