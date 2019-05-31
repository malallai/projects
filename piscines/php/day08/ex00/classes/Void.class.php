<?php

require_once 'SpaceEntity.class.php';
require_once 'Map.class.php';
class Void extends SpaceEntity {

    public static function doc() {
        if (file_exists("doc/Void.doc.txt")) {
            return file_get_contents("doc/Void.doc.txt");
        }
        return "";
    }

    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
    }

}