<?php
// les constantes :
require_once(__DIR__ . '/../config/constants.php');

// le helper :
require_once(__DIR__ . '/../helper/dd.php');


class Database
{
    private static $connection;

    // pour la transaction :
    public static function getInstance()
    {
        if (is_null(self::$connection)) {
            self::$connection = new PDO(DSN, USER, PASSWORD);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }
        return self::$connection;
    }
}
