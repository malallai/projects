<?php


class Asteroid extends SpaceEntity {

    public $shape;
    public $sizeX;
    public $sizeY;

    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
        $size = rand(0, 10);
        $this->sizeX = $size / 2;
        $this->sizeY = $size / 2;
        for ($shapeX = 0; $shapeX < $this->sizeX; $shapeX++) {
            for ($shapeY = 0; $shapeY < $this->sizeY; $shapeY++) {
                $this->shape[] = array("x" => $shapeX + $x, "y" => $shapeY + $y);
                $this->getMap()->getGrid()[$shapeY + $y][$shapeX + $x] = $this;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getShape()
    {
        return $this->shape;
    }

}