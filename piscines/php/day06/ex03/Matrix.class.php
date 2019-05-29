<?php

require_once '../ex01/Vertex.class.php';
require_once '../ex02/Vector.class.php';
class Matrix
{
    const IDENTITY      = "IDENTITY";
    const SCALE         = "SCALE preset";
    const TRANSLATION   = "TRANSLATION preset";
    const PROJECTION    = "PROJECTION preset";
    const RX            = "Ox ROTATION preset";
    const RY            = "Oy ROTATION preset";
    const RZ            = "Oz ROTATION preset";

    public static $verbose = False;
    private $_preset;
    private $_scale;
    private $_angle;
    private $_vtc;
    private $_fov;
    private $_ratio;
    private $_near;
    private $_far;

    public $_matrix;

    function doc() {
        if (file_exists("Matrix.doc.txt")) {
            return file_get_contents("Matrix.doc.txt");
        }
        return "";
    }

    function __construct(array $params) {
        $this->_preset = $params['preset'];
        $this->_matrix = array(array(1, 0, 0, 0), array(0, 1, 0, 0), array(0, 0, 1, 0), array(0, 0, 0, 1));
        switch ($this->getPreset()) {
            case Matrix::SCALE: {
                $this->_scale = $params['scale'];
                $this->_matrix[0][0] *= $this->_scale;
                $this->_matrix[1][1] *= $this->_scale;
                $this->_matrix[2][2] *= $this->_scale;
                break;
            }
            case Matrix::TRANSLATION: {
                $this->_vtc = $params['vtc'];
                $this->_matrix[0][3] = $this->_vtc->getX();
                $this->_matrix[1][3] = $this->_vtc->getY();
                $this->_matrix[2][3] = $this->_vtc->getZ();
                break;
            }
            case Matrix::PROJECTION: {
                $this->_fov = deg2rad($params['fov']);
                $this->_ratio = $params['ratio'];
                $this->_near = $params['near'];
                $this->_far = $params['far'];
                $this->_matrix[0][0] = 1 / ($this->_ratio * tan($this->_fov / 2));
                $this->_matrix[1][1] =  1 / (tan($this->_fov / 2));
                $this->_matrix[2][2] = ($this->_near + $this->_far) / ($this->_near - $this->_far);
                $this->_matrix[3][2] = -1;
                $this->_matrix[2][3] = 2 * ($this->_near * $this->_far) / ($this->_near - $this->_far);
                $this->_matrix[3][3] = 0;
                break;
            }
            case Matrix::RX: {
                $this->_angle = $params['angle'];
                $this->_matrix[1][1] = cos($this->_angle);
                $this->_matrix[1][2] = -sin($this->_angle);
                $this->_matrix[2][1] = sin($this->_angle);
                $this->_matrix[2][2] = cos($this->_angle);
                break;
            }
            case Matrix::RY: {
                $this->_angle = $params['angle'];
                $this->_matrix[0][0] = cos($this->_angle);
                $this->_matrix[0][2] = sin($this->_angle);
                $this->_matrix[2][0] = -sin($this->_angle);
                $this->_matrix[2][2] = cos($this->_angle);
                break;
            }
            case Matrix::RZ: {
                $this->_angle = $params['angle'];
                $this->_matrix[0][0] = cos($this->_angle);
                $this->_matrix[0][1] = -sin($this->_angle);
                $this->_matrix[1][0] = sin($this->_angle);
                $this->_matrix[1][1] = cos($this->_angle);
                break;
            }
            default : break;
        }
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
        return(sprintf( "M | vtcX | vtcY | vtcZ | vtxO".PHP_EOL.
                                "-----------------------------".PHP_EOL.
                                "x | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
                                "y | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
                                "z | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
                                "w | %.2f | %.2f | %.2f | %.2f",
            $this->_matrix[0][0],$this->_matrix[0][1],$this->_matrix[0][2],$this->_matrix[0][3],
            $this->_matrix[1][0],$this->_matrix[1][1],$this->_matrix[1][2],$this->_matrix[1][3],
            $this->_matrix[2][0],$this->_matrix[2][1],$this->_matrix[2][2],$this->_matrix[2][3],
            $this->_matrix[3][0],$this->_matrix[3][1],$this->_matrix[3][2],$this->_matrix[3][3]
        ));
    }

    public function getPreset() {
        return $this->_preset;
    }

    public function mult(Matrix $rhs) {
        $ret = clone($rhs);
        $ret->_matrix = array(  array(0, 0, 0, 0),
                                array(0, 0, 0, 0),
                                array(0, 0, 0, 0),
                                array(0, 0, 0, 0));
        for($i = 0; $i < 4; $i++)
            for ($j = 0; $j < 4; $j++)
                for ($k = 0; $k < 4; $k++)
                    $ret->_matrix[$i][$j] += $this->_matrix[$i][$k] * $rhs->_matrix[$k][$j];
        return($ret);
    }

    public function transformVertex(Vertex $vert) {
        // $x = Vx * M(X, vtcX) + Vy * M(X, vtcY) + Vz * M(X, vtcZ) + Vw * M(X, vtc0)
        // $y = Vx * M(Y, vtcX) + Vy * M(Y, vtcY) + Vz * M(Y, vtcZ) + Vw * M(Y, vtc0)
        // $z = Vx * M(Z, vtcX) + Vy * M(Z, vtcY) + Vz * M(Z, vtcZ) + Vw * M(Z, vtc0)
        // $w = Vx * M(W, vtcX) + Vy * M(W, vtcY) + Vz * M(W, vtcZ) + Vw * M(W, vtc0)
        $x =  $vert->getX() * $this->_matrix[0][0]
                + $vert->getY() * $this->_matrix[0][1]
                + $vert->getZ() * $this->_matrix[0][2]
                + $vert->getW() * $this->_matrix[0][3];
        $y =  $vert->getX() * $this->_matrix[1][0]
                + $vert->getY()*$this->_matrix[1][1]
                + $vert->getZ()*$this->_matrix[1][2]
                + $vert->getW()*$this->_matrix[1][3];
        $z =  $vert->getX() * $this->_matrix[2][0]
                + $vert->getY()*$this->_matrix[2][1]
                + $vert->getZ()*$this->_matrix[2][2]
                + $vert->getW()*$this->_matrix[2][3];
        $w =  $vert->getX() * $this->_matrix[3][0]
                + $vert->getY()*$this->_matrix[3][1]
                + $vert->getZ()*$this->_matrix[3][2]
                + $vert->getW()*$this->_matrix[3][3];
        return (new Vertex(array("x"=>$x, "y"=>$y, "z"=>$z, "w"=>$w)));
    }

}