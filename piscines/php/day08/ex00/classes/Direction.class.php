<?php

abstract class Direction {
    const up = 0;
    const down = 1;
    const left = 2;
    const right = 3;

    public static function doc() {
        if (file_exists("doc/Direction.doc.txt")) {
            return file_get_contents("doc/Direction.doc.txt");
        }
        return "";
    }
}