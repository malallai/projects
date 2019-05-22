#!/usr/bin/php
<?php
    if (!($argc == 2 && ($argv[1] === "moyenne" ||
        $argv[1] === "moyenne_user" || $argv[1] === "ecart_moulinette"))) {
        die;
    }

    $func = $argv[1];
    $tables = fgets(STDIN);
    $array = null;
    $datas = array();
    $notes = array();
    $mouli_notes = array();

    while (feof(STDIN) !== true) {
        $array[] = fgets(STDIN);
    }

    if ($array) {
        sort($array);
        foreach ($array as $value) {
            $datas[] = str_getcsv($value, ';');
        }
        if ($func === 'moyenne') {
            foreach ($datas as $data) {
                if ($data[1] !== "" && $data[1] !== null && $data[2] !== 'moulinette') {
                    $notes[] = $data[1];
                }
            }
            echo array_sum($notes) / count($notes) . "\n";
        } else if ($func === 'moyenne_user') {
            foreach ($datas as $data) {
                if ($data[1] !== "" && $data[1] !== null && $data[2] !== 'moulinette') {
                    $notes[$data[0]][] = $data[1];
                }
            }
            foreach ($notes as $user => $note) {
                echo $user.":".array_sum($note) / count($note)."\n";
            }
        } else if ($func === 'ecart_moulinette') {
            foreach ($datas as $data) {
                if ($data[1] !== "" && $data[1] !== null) {
                    if ($data[2] === 'moulinette') {
                        $mouli_notes[$data[0]] = $data[1];
                    } else {
                        $notes[$data[0]][] = $data[1];
                    }
                }
            }
            foreach ($notes as $user => $note) {
                echo $user.":".((array_sum($note) / count($note)) - $mouli_notes[$user])."\n";
            }
        }
    }
