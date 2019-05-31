#!/usr/bin/php
<?php

    if ($argc < 2) {
        die;
    }

    function ft_split($string) {
        $array = array_filter(explode(' ', $string));
        return ($array);
    }

    function wrong_format($i) {
        die("Wrong Format\n");
    }

    $days = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
    $months = array("janvier" => 1, "février" => 2, "fevrier" => 2, "mars" => 3, "avril" => 4, "mai" => 5, "juin" => 6,
        "juillet" => 7, "aout" => 8, "août" => 8, "septembre" => 9, "octobre" => 10, "novembre" => 11, "décembre" => 12,
        "decembre" => 12);

    $date = $argv[1];
    $exploded = ft_split($date);

    if (count($exploded) != 5) {
        wrong_format(0);
    }

    $day_name = $exploded[0];
    $day = $exploded[1];
    $month = $exploded[2];
    $year = $exploded[3];
    $time = $exploded[4];

    if (!in_array(strtolower($day_name), $days) || !array_key_exists(strtolower($month), $months)) {
        wrong_format(1);
    }

    if (!is_numeric($day) || !is_numeric($year) || strlen($year) !== 4 || $year < 1970) {
        wrong_format(2);
    }

    if (strlen($day) === 1 && !preg_match("/^[1-9]/", $day)) {
        wrong_format(3);
    }

    if (strlen($day) === 2 && !preg_match("/^((3)[0-1]|[1-2]\d)/", $day)) {
        wrong_format(4);
    }

    if (!preg_match("/^((2)[0-3]|[0-1]\d):([0-5]\d):([0-5]\d)/", $time)) {
        wrong_format(5);
    }

    date_default_timezone_set("CET");
    print strtotime($months[$month] . "/" . $day . "/" . $year . " " . $time) . "\n";
