<?php


namespace Core;

use PDO;
use PDOException;
class Sql {

    protected static $_conn;

    protected function init_no_db($clear = false) {
        require 'config/database.php';
        if ($clear) {
            self::$_conn = null;
        } else if (self::$_conn) {
            return self::$_conn;
        }
        try {
            $host = 'mysql:'.explode(';', $DB_DSN)[1];
            self::$_conn = new \PDO($host, $DB_USER, $DB_PASSWORD);
        } catch (\PDOException $e) {
            // TODO Error
        }
    }

    protected function init_db($clear = false) {
        require 'config/database.php';
        if ($clear) {
            self::$_conn = null;
        } else if (self::$_conn) {
            return self::$_conn;
        }
        try {
            self::$_conn = new \PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        } catch (\PDOException $e) {
            // TODO Error
        }
    }
}