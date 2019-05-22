#!/usr/bin/php
<?php
    function doop($i1, $op, $i2) {
        $result = 0;
        if ($op === '+')
            $result = $i1 + $i2;
        else if ($op === '-')
            $result = $i1 - $i2;
        else if ($op === '*')
            $result = $i1 * $i2;
        else if ($op === '/')
            $result = $i1 / $i2;
        else if ($op === '%')
            $result = $i1 % $i2;
        return $result;
    }

    if ($argc != 4) {
        print "Incorrect Parameters\n";
        die;
    }

    $i1 = trim($argv[1]);
    $op = trim($argv[2]);
    $i2 = trim($argv[3]);

    print doop($i1, $op, $i2)."\n";