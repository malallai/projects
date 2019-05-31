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

    if ($argc != 2) {
        print "Incorrect Parameters\n";
        die;
    }

    $value = str_replace(" ","", trim($argv[1]));
    $i1 = intval($value);
    $op = substr($value, strlen($i1), 1);
    $i2 = substr($value, strlen($i1) + 1, strlen($value));

    if (is_numeric($i1) !== true || is_numeric($i2) !== true) {
        print "Syntax Error\n";
        die;
    }

    print doop($i1, $op, $i2)."\n";