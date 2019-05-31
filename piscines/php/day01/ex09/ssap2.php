#!/usr/bin/php
<?php
    function ft_split($string) {
        $array = array_filter(explode(' ', $string));
        return ($array);
    }

    function print_array($array) {
        foreach ($array as $entry) {
            print $entry."\n";
        }
    }

    function is_alpha($str) {
        $split = str_split($str);
        foreach ($split as $char) {
            $i = ord($char);
            print $char.": ".$i."\n";
            if (!(($i >= 65 && $i <= 90) || ($i >= 97 && $i <= 122))) {
                print "\n";
                return false;
            }
        }
        print "\n";
        return true;
    }

    $array = array();
    $strs = array();
    $nbrs = array();
    $others = array();

    $i = 1;
    while ($i < $argc) {
        $array = array_merge($array, ft_split($argv[$i]));
        $i++;
    }

    if ($array !== null) {
        foreach ($array as $value) {
            if (is_numeric($value) === true) {
                array_push($nbrs, $value);
            } else if (ctype_alpha($value) === true) {
                array_push($strs, $value);
            } else {
                array_push($others, $value);
            }
        }
        sort($strs, SORT_NATURAL | SORT_FLAG_CASE);
        sort($nbrs, SORT_STRING);
        sort($others);
        print_array($strs);
        print_array($nbrs);
        print_array($others);
    }
