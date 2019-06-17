<?php

namespace Core;

class Snackbar {

    public static function send_snack($message) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $snacks = array();
        if (self::has_snack()) {
            $snacks = self::get_snack();
        }
        array_push($snacks, $message);
        $_SESSION['snack'] = $snacks;
    }

    public static function get_snack() {
        if (self::has_snack()) {
            return $_SESSION['snack'];
        }
    }

    public static function has_snack() {
        return isset($_SESSION['snack']) && !empty($_SESSION['snack']) && sizeof($_SESSION['snack']) !== 0;
    }

    public static function reset_snack() {
        unset($_SESSION['snack']);
    }

    public static function render_snacks() {
        $result = "";
        $snacks = self::get_snack();
        foreach ($snacks as $key => $snack) {
            $result .= self::render_snack($snack);
            unset($snacks[$key]);
        }
        $_SESSION['snack'] = $snacks;
        return $result;
    }

    public static function render_snack($message) {
        return "<script>new_snackbar(\"$message\")</script>";
    }

}