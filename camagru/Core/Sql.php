<?php


namespace Core;

use Exceptions\SqlException;
use PDO;
use PDOException;
class Sql {

    protected static $_conn;

    public static function compareTokens($token) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
            if ($_SESSION['token'] === $token) {
                return true;
            }
        }
        return false;
    }

    protected static function init_no_db($clear = false) {
        require 'config/database.php';
        if ($clear) {
            self::$_conn = null;
        } else if (self::getConn()) {
            return self::getConn();
        }
        try {
            $host = 'mysql:'.explode(';', $DB_DSN)[1];
            self::$_conn = new \PDO($host, $DB_USER, $DB_PASSWORD);
        } catch (PDOException $e) {
            throw new SqlException("Mysql Error during connection to database. Please contact us.");
        }
    }

    protected static function init_db($clear = false) {
        require 'config/database.php';
        if ($clear) {
            self::$_conn = null;
        } else if (self::getConn()) {
            return self::getConn();
        }
        try {
            self::$_conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        } catch (PDOException $e) {
            throw new SqlException("Mysql Error during connection to database. Please contact us.");
        }
    }

    protected static function run($request, $args = array(), $fetch = null) {
        try {
            $response = self::runList($request, $args, $fetch);
            return array("statement" => $response['statement'], 'result' => $response['result'][0]);
        } catch (SqlException $e) {
            throw new SqlException("Error during sql statement. Please contact us.");
        }
    }

    protected static function runList($request, $args = array(), $fetch = null) {
        try {
            self::init_db();
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        try {
            $connection = self::getConn();
            $statement = $connection->prepare($request);
            $statement->execute($args);
            $result = array();
            while ($fetchResult = $statement->fetch($fetch)) {
                array_push($result, $fetchResult);
            }
            return array("result"=>$result, "statement"=>$statement);
        } catch (PDOException $e) {
            throw new SqlException("Error during sql statement. Please contact us.");
        }
    }

    protected static function bindRun($request, $args = array(), $fetch = null) {
        try {
            $response = self::bindRunList($request, $args, $fetch);
            return array("statement" => $response['statement'], 'result' => $response['result'][0]);
        } catch (SqlException $e) {
            throw new SqlException("Error during sql statement. Please contact us.");
        }
    }

    protected static function bindRunList($request, $args = array(), $fetch = null) {
        try {
            self::init_db();
        } catch (SqlException $e) {
            Snackbar::send_snack($e->getMessage());
            return false;
        }
        try {
            $connection = self::getConn();
            $statement = $connection->prepare($request);
            $key = 1;
            foreach ($args as $value => $type) {
                Snackbar::send_snack($value . " : " . $type . " - " . $key);
                $statement->bindParam($key, $value, $type);
                $key++;
            }
            $statement->execute();
            $result = array();
            while ($fetchResult = $statement->fetch($fetch)) {
                array_push($result, $fetchResult);
            }
            return array("result"=>$result, "statement"=>$statement);
        } catch (PDOException $e) {
            throw new SqlException("Error during sql statement. Please contact us.");
        }
    }

    /**
     * @return PDO
     */
    public static function getConn() {
        return self::$_conn;
    }

}