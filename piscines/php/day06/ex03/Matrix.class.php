<?php


class Matrix
{
    public static $verbose = False;

    function doc() {
        if (file_exists("Matrix.doc.txt")) {
            return file_get_contents("Matrix.doc.txt");
        }
        return "";
    }

    function __construct(array $array) {
        if (self::$verbose) {
            echo "Matrix ".$this->getPreset()." instance constructed".PHP_EOL;
        }
    }

    function __destruct() {
        if (self::$verbose) {
            echo "Matrix instance destructed".PHP_EOL;
        }
    }

    function __toString() {
        return (sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->getW()));
    }
}