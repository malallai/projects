#!/usr/bin/php
<?php

    if ($argc < 2) {
        die;
    }

    $file = fopen($argv[1], "r") or exit("Unable to open file " . $argv[1]);
    $text = fread($file, filesize($argv[1]));

    $text = preg_replace_callback("", function ($matches) {

    }, $text);

    fclose($file);
