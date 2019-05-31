<?php

require_once 'Map.class.php';
interface Entity {

    public function __construct(Map $map, $x, $y);

}