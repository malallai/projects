<?php


class Color
{
    public static $verbose = False;
    public $red = 0;
    public $green = 0;
    public $blue = 0;

    public static function doc() {
        if (file_exists("Color.doc.txt")) {
            return file_get_contents("Color.doc.txt");
        }
        return "";
    }

    private static function pad($value, $padding = 3) {
        if (strlen($value) != $padding) {
            while (strlen($value) != $padding)
                $value = " ".$value;
        }
        return $value;
    }

    function __construct(array $arr) {
        if (array_key_exists('red', $arr) && array_key_exists('green', $arr) && array_key_exists('blue', $arr)) {
            $this->red = (int)$arr['red'];
            $this->green = (int)$arr['green'];
            $this->blue = (int)$arr['blue'];
        } else if (array_key_exists('rgb', $arr)) {
            $this->blue = $arr['rgb'] % 256;
            $arr['rgb'] /= 256;
            $this->green = $arr['rgb'] % 256;
            $arr['rgb'] /= 256;
            $this->red = $arr['rgb'] % 256;
        }
        if (self::$verbose) {
            echo $this . " constructed.\n";
        }
    }

    function __destruct() {
        if (self::$verbose) {
            echo $this . " destructed.\n";
        }
    }

    function __toString() {
        return 'Color( red: ' . $this->pad($this->red) . ', green: ' . $this->pad($this->green) . ', blue: ' . $this->pad($this->blue) . ' )';
    }

    function add(Color $color) {
        return (new Color(array(
            'red' => $color->red + $this->red,
            'green' => $color->green + $this->green,
            'blue' => $color->blue + $this->blue
        )));
    }

    function sub(Color $color) {
        return (new Color(array(
            'red' => $this->red - $color->red,
            'green' => $this->green - $color->green,
            'blue' => $this->blue - $color->blue
        )));
    }

    function mult($fact) {
        return (new Color(array(
            'red' => $fact * $this->red,
            'green' => $fact * $this->green,
            'blue' => $fact * $this->blue
        )));
    }

}