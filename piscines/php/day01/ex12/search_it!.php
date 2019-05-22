#!/usr/bin/php
<?php
    $search = $argv[1];
    $find_value = null;

    $i = 2;
    while ($i < $argc) {
        $tmp = explode(':', $argv[$i]);
        if ($tmp[0] === $search)
            $find_value = $tmp[1];
        $i++;
    }

    if ($find_value)
        print $find_value."\n";
