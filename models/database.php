<?php
// les constantes :
require_once(__DIR__ . '/../config/constants.php');

// le helper :
require_once(__DIR__ . '/../helper/dd.php');


function dbConnect()
{
    $db = new PDO(DSN, USER, PASSWORD);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    return $db;
}

// class Database
// {
//     static private $db = NULL;
//     static private $dbInstance = NULL;

//     /**
//      * Constructeur défini en privé pour le rendre inaccessible
//      */
//     private function __construct()
//     {
//         self::$db = new PDO(DSN, USER, PASSWORD);
//         self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
//         self::$db->query("SET NAMES 'utf8'");
//     }
    /**
     * Methode magique de destruction de l'instance MySQL
     */
    // public function __destruct()
    // {
    //     self::$db = null;
    // }
      /**
    * Méthode magique pour rétablir toute connexion de base de données 
    * qui aurait été perdue durant la linéarisation
    */
    // public function __wakeUp( ) {
    //     // Vérification de la connexion
    //     if(self::$dbInstance instanceof self) {
    //             throw new Exception();
    //     }
    //     // Correction de la reference
    //     self::$dbInstance = $this;
    // }
    
    /**
     * Méthode magique pour l'appel des fonctions de l'objet PDO quand 
     * elles ne sont pas définies dans la classe
     * 
      * @param type $method
      * @param type $params
      */
    // public function __call($method, $params) {
    //     if(self::$db == NULL){
    //         self::__construct();
    //     }
        
    //     return call_user_func_array(array(self::$db, $method), $params);
    // }
    
   /**
    * Fournit l'unique instance du Singleton
    *
    * @return    DATABASE
    */
//     static public function getInstance(){
//         // Verification que l'instance n'a pas déja ete initialisée
//         if(!(self::$dbInstance instanceof self)){
//             self::$dbInstance = new self();
//         }
//         // Retour de l'instance unique
//         return self::$dbInstance;
//     }  
// }
