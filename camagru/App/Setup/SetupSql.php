<?php

namespace App\Setup;

use Core\Page;
use Core\Sql;
use Core\Snackbar;
use Exceptions\SqlException;
class SetupSql extends Sql {

    public function setup() {
        try {
            self::initNoDb(true);
        } catch (SqlException $e) {
            Snackbar::sendSnacks($e->getMessage());
            Page::redirect("/setup");
            return false;
        }
        try {
            $config = self::getConfig()['db_dsn'];
            self::run("CREATE DATABASE " . explode("=", explode(";", $config)[0])[1]);
        } catch (SqlException $e) {
            Snackbar::sendSnacks($e->getMessage());
            Page::redirect("/setup");
            return false;
        }
        try {
            self::initDb(true);
        } catch (SqlException $e) {
            Snackbar::sendSnacks($e->getMessage());
            Page::redirect("/setup");
            return false;
        }
        $queries = [
            "CREATE TABLE users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            notifications BOOLEAN DEFAULT 1,
            conf_token VARCHAR(255) NULL,
            confirmed BOOLEAN DEFAULT 0,
            avatar VARCHAR(255) DEFAULT '0')",
            "CREATE TABLE pwd_reset (
            user_id INT(11) UNSIGNED NOT NULL,
            token VARCHAR(255),
            FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE)",
            "CREATE TABLE posts (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT(11) UNSIGNED NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
            image_path VARCHAR(255) NOT NULL,
            date TIMESTAMP DEFAULT current_timestamp())",
            "CREATE TABLE likes (
            post_id INT(11) UNSIGNED NOT NULL,
            FOREIGN KEY (post_id) REFERENCES posts(id) ON UPDATE CASCADE ON DELETE CASCADE,
            user_id INT(11) UNSIGNED NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE)",
            "CREATE TABLE comments (
            post_id INT(11) UNSIGNED NOT NULL,
            FOREIGN KEY (post_id) REFERENCES posts(id) ON UPDATE CASCADE ON DELETE CASCADE,
            user_id INT(11) UNSIGNED NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
            comment VARCHAR(255) NOT NULL,
            date TIMESTAMP DEFAULT current_timestamp())",
            "CREATE TABLE timer (
            user_id INT(11) UNSIGNED NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
            last_comment TIMESTAMP DEFAULT current_timestamp())"
        ];
        foreach ($queries as $query) {
            try {
                self::run($query);
            } catch (PDOException $e) {
                Snackbar::sendSnacks($e->getMessage());
                Page::redirect("/setup");
            }
        }
        return true;
    }

    public static function tryConnection() {
        try {
            self::initDb(true);
            return true;
        } catch (SqlException $e) {
            return false;
        }
    }

}