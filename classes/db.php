<?php
include "/config/config.php";

class DB
{
    private static $pdo;
    public static function connection()
    {
        //Create a database connection if $pd is not set
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,  DB_USER, DB_PASS);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
