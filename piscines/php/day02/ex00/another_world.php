#!/usr/bin/php
<?php
    if ($argc === 1) {
        die;
    }
    $string = $argv[1];
    $regx = "/[\t ]+/";
    $explode = preg_split($regx, trim($string));
    foreach ($explode as $val) {
        print $val." ";
    }
    print "\n";