<?php


namespace Core;


class Security {

    public static function compareTokens($token) {
        Session::startSession();
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            if ($_SESSION['token'] === $token) {
                return true;
            }
        }
        return false;
    }

    public static function newToken($size) {
        try {
            return bin2hex(random_bytes($size));
        } catch (\Exception $exception) {
            Snackbar::sendSnack($exception->getMessage());
            return false;
        }
    }

    public static function convertChars($value) {
        return htmlspecialchars($value);
    }

    public static function convertPassword($value) {
        return htmlspecialchars(htmlentities($value));
    }

}