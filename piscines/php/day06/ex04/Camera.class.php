<?php

require_once '../ex01/Vertex.class.php';
require_once '../ex02/Vector.class.php';
require_once '../ex03/Matrix.class.php';
class Camera {

    public static $verbose = False;

    private $_origin;
    private $_orient;
    private $_width;
    private $_height;
    private $_ratio;
    private $_fov;
    private $_near;
    private $_far;
    private $_projection;
    private $_tT;
    private $_tR;
    private $_view_matrix;

    function doc() {
        if (file_exists("Camera.doc.txt")) {
            return file_get_contents("Camera.doc.txt");
        }
        return "";
    }

    function __construct(array $params) {
        $this->_origin = $params['origin'];
        $this->_orient = $params['orientation'];
        if(array_key_exists('width', $params) && array_key_exists('height', $params)) {
            $this->_width = $params['width'];
            $this->_height = $params['height'];
            $camera['ratio'] = ($this->_width) / ($this->_height);
        }
        $this->_ratio = $params["ratio"];
        $this->_fov = $params['fov'];
        $this->_near = $params['near'];
        $this->_far = $params['far'];

        $this->_tT = $this->gettT();
        $this->_tR = $this->getDiagonal($this->_orient);
        $this->_view_matrix = $this->_tR->mult($this->_tT);
        $this->_projection = new Matrix(array('preset' => Matrix::PROJECTION,
            'fov' => $this->_fov,
            'near' => $this->_near,
            'far' => $this->_far,
            'ratio' => $this->_ratio));
        if (self::$verbose) {
            echo "Camera instance constructed".PHP_EOL;
        }
    }

    function __destruct() {
        if (self::$verbose) {
            echo "Camera instance destructed".PHP_EOL;
        }
    }

    function __toString() {
        return(sprintf( "Camera(" . PHP_EOL .
                                "+ Origine: %s".PHP_EOL.
                                "+ tT: ".PHP_EOL.
                                "%s".PHP_EOL.
                                "+ tR:".PHP_EOL.
                                "%s".PHP_EOL.
                                "+ tR->mult( tT ):".PHP_EOL.
                                "%s".PHP_EOL.
                                "+ Proj:".PHP_EOL.
                                "%s".PHP_EOL.")",
            $this->_origin, $this->gettT(), $this->_tR, $this->_tR->mult($this->gettT()), $this->_projection));
    }

    public function gettT() {
        if ($this->_tT)
            return ($this->_tT);
        $oppv = new Vector(array('dest' => $this->_origin));
        return (new Matrix(array('preset' => Matrix::TRANSLATION, 'vtc' => $oppv->opposite())));
    }

    public function getDiagonal(Matrix $tT) {
        $tmp = clone($tT);

        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $tmp->_matrix[$i][$j] = $tT->_matrix[$j][$i];
            }
        }
        return ($tmp);
    }

    public function watchVertex(Vertex $worldVertex) {
        $vert = $this->_tR->transformVertex($worldVertex);
        $vtx = $this->_projection->transformVertex($vert);
        $vtx->setX($vtx->getX() * $this->_ratio);
        $vtx->setY($vtx->getY());
        $vtx->setColor($worldVertex->getColor());
        return ($vtx);
    }
}