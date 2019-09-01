<?php


namespace Core;
class Session {

    public static function isStart() {
        return session_status() == PHP_SESSION_ACTIVE;
    }

    public static function startSession() {
        if (!self::isStart()) {
            session_start();
        }
    }

    public static function destroySession() {
        if (self::isStart()) {
            session_destroy();
        }
    }

    public static function resetSession() {
        if (self::isStart()) {
            $_SESSION = array();
            self::destroySession();
        }
    }

}