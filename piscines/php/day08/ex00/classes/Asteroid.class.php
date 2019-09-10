<?php


class Asteroid extends SpaceEntity {

    public $shape;
    public $sizeX;
    public $sizeY;
    private $_max_size = 10;


    public static function doc() {
        if (file_exists("doc/Asteroid.doc.txt")) {
            return file_get_contents("doc/Asteroid.doc.txt");
        }
        return "";
    }


    public function __construct(Map $map, $x, $y) {
        parent::__construct($map, $x, $y);
        $size = rand(3, $this->_max_size);
        $this->sizeX = $size / 2;
        $this->sizeY = $size / 2;
        for ($shapeX = 0; $shapeX < $this->sizeX; $shapeX++) {
            for ($shapeY = 0; $shapeY < $this->sizeY; $shapeY++) {
                $this->shape[] = array("x" => $shapeX + $x, "y" => $shapeY + $y);
                $this->getMap()->grid[$shapeY + $y][$shapeX + $x] = $this;
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
