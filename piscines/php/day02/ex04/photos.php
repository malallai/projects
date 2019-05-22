#!/usr/bin/php
<?php

    if ($argc < 2) {
        die;
    }

    $curl = curl_init($argv[1]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    /**
     * ? : lazy match few char
     * .* : match anything except line break
     */
    preg_match_all("/<img.*src=['\"].*?['\"].*?>/i", $response, $matches);
    if (count($matches[0]) > 0) {
        $dir = getcwd() . "/" . str_replace("/", "-", str_replace("http://", "", str_replace("https://", "", $argv[1])));
        $dir = preg_replace("/-$/", "", $dir);
        if (!file_exists($dir) && !is_dir($dir)) mkdir($dir);
        chdir($dir);
        foreach ($matches[0] as $img) {
            preg_match_all("/src=['\"](.*?)['\"]/i", $img, $new_matches);
            foreach ($new_matches[1] as $link) {
                $exploded = explode('/', $link);
                $file_name = $exploded[count($exploded) - 1];
                $url = $link;
                if (substr($link, 0, 4 ) !== "http") {
                    $url = $argv[1]."/".$link;
                }
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $img_response = curl_exec($curl);
                curl_close($curl);
                $file = fopen($file_name, 'w');
                fwrite($file, $img_response);
                fclose($file);
            }
        }
    }
