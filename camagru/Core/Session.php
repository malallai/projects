<?php


namespace Core;
class Session {

    public static function checkSession() {
        return session_status() !== PHP_SESSION_NONE;
    }

    public static function startSession() {
        Snackbar::send_snack(self::checkSession());
        if (!self::checkSession()) {
            session_start();
        }
    }

    public static function destroySession() {
        if (self::checkSession()) {
            session_destroy();
        }
    }

    public static function resetSession() {
        if (self::checkSession()) {
            $_SESSION = array();
            self::destroySession();
        }
    }

}