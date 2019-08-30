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

    public static function convertHtmlEntities($value) {
        $value = htmlspecialchars($value);
        return htmlentities($value);
    }

}