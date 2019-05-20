#!/usr/bin/php
<?php
    function ft_split($string) {
        $array = array_filter(explode(' ', $string));
        return ($array);
    }

    unset($argv[0]);
    $array = array();
    foreach($argv as $arg)
        foreach(ft_split($arg) as $v)
            array_push($array, $v);
    sort($array);
    foreach($array as $value)
        echo $value."\n";
?>
