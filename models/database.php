<?php
// les constantes :
require_once(__DIR__ . '/../config/constants.php');

// le helper :
require_once(__DIR__ . '/../helper/dd.php');


class Database
{

    public static function getInstance()
    {

        $db = new PDO(DSN, USER, PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $db;
    }

}