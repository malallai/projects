#!/usr/bin/php
<?php

    function ft_split($string) {
        $array = array_filter(explode(' ', $string));
        return ($array);
    }

    $array = ft_split($argv[1]);
    $final = "";
    foreach ($array as $str)
        $final .= $str." ";
    echo trim($final)."\n";
?>