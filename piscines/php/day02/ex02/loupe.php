#!/usr/bin/php
<?php
if ($argc >= 2) {
    $file = fopen($argv[1], "r") or exit("Unable to open file " . $argv[1]);
    $text = fread($file, filesize($argv[1]));
    $text = preg_replace_callback("/((((<a ))(.*?)(>))|(<a>))(.*)(<\/a>)/i", function($matches) {
        $matches[0] = preg_replace_callback("/(title=\")(.*?)(\")/", function ($matches) {
            return $matches[1].strtoupper($matches[2]).$matches[3];
        }, $matches[0]);
        $matches[0] = preg_replace_callback("/(>)(.*?)(<)/", function ($matches) {
            return $matches[1].strtoupper($matches[2]).$matches[3];
        }, $matches[0]);
        return ($matches[0]);
    }, $text);
    echo $text;
    fclose($file);
}