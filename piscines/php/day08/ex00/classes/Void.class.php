<?php

require_once 'SpaceEntity.class.php';
require_once 'Map.class.php';
class Void extends SpaceEntity {

    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
    }

}