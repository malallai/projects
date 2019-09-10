<?php

namespace Core;
class Snackbar {

    public static function sendSnack($message) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $snacks = array();
        if (self::hasSnack()) {
            $snacks = self::getSnack();
        }
        array_push($snacks, $message);
        $_SESSION['snack'] = $snacks;
    }

    public static function sendSnacks(...$messages) {
        $array = func_get_args();
        var_dump($array[0]);
        foreach ($array as $message) {
            self::sendSnack($message);
        }
    }

    public static function getSnack() {
        if (self::hasSnack()) {
            return $_SESSION['snack'];
        }
    }

    public static function hasSnack() {
        return isset($_SESSION['snack']) && !empty($_SESSION['snack']) && sizeof($_SESSION['snack']) !== 0;
    }

    public static function resetSnack() {
        unset($_SESSION['snack']);
    }

    public static function renderSnacks() {
        $result = "";
        $snacks = self::getSnack();
        foreach ($snacks as $key => $snack) {
            $result .= self::renderSnack($snack);
            unset($snacks[$key]);
        }
        $_SESSION['snack'] = $snacks;
        return $result;
    }

    public static function renderSnack($message) {
        return "<script>new_snackbar(\"$message\")</script>";
    }

}