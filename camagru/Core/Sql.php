<?php

namespace Core;

use Exceptions\SqlException;
use PDO;
use PDOException;
class Sql {

    protected static $_conn;

    protected static function getConfig() {
        require 'config/database.php';
        return array("db_dsn" => $DB_DSN, "db_user" => $DB_USER, "db_password" => $DB_PASSWORD);
    }

    protected static function initNoDb($clear = false) {
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
            throw new SqlException("Mysql Error during connection to database. Please contact us. (".$e->getMessage().")");
        }
        return true;
    }

    protected static function initDb($clear = false) {
        require 'config/database.php';
        if ($clear) {
            self::$_conn = null;
        } else if (self::getConn()) {
            return self::getConn();
        }
        try {
            self::$_conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        } catch (PDOException $e) {
            throw new SqlException("Mysql Error during connection to database. Please contact us. (".$e->getMessage().")");
        }
        return true;
    }

    protected static function run($request, $args = array(), $fetch = null) {
        try {
            $response = self::runList($request, $args, $fetch);
            return array("statement" => $response['statement'], 'result' => sizeof($response['result']) > 0 ? $response['result'][0] : $response['result']);
        } catch (SqlException $e) {
            throw new SqlException("Error during sql statement. Please contact us.");
        }
    }

    protected static function runList($request, $args = array(), $fetch = null) {
        try {
            self::initDb();
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
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

    protected static function bindValueRun($request, $args = array(), $fetch = null) {
        try {
            $response = self::bindValueRunList($request, $args, $fetch);
            return array("statement" => $response['statement'], 'result' => $response['result'][0]);
        } catch (SqlException $e) {
            throw new SqlException("Error during sql statement. Please contact us.");
        }
    }

    protected static function bindValueRunList($request, $args = array(), $fetch = null) {
        try {
            self::initDb();
        } catch (SqlException $e) {
            Snackbar::sendSnack($e->getMessage());
            return false;
        }
        try {
            $connection = self::getConn();
            $statement = $connection->prepare($request);
            foreach ($args as $key => $values) {
                $statement->bindValue($key, $values[0], $values[1]);
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

    public static function getConn() {
        return self::$_conn;
    }

}