<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');


class Patient
{
    private int $id;
    private string $lastname;
    private string $firstname;
    private string $birthdate;
    private string $phone;
    private string $mail;

    public function __construct(string $lastname, string $firstname, string $birthdate, string $phone, string $mail)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->mail = $mail;
    }


    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }


    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setBirthdate(string $birthdate)
    {
        $this->birthdate = $birthdate;
    }
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }
    public function getMail(): string
    {
        return $this->mail;
    }


    public function add()
    {

        //On se connecte à la BDD
        $db = dbConnect();

        //On insère les données reçues   
        // on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur
        $sth = $db->prepare("
        INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`)
        VALUES(:lastname, :firstname, :birthdate, :phone, :mail)");
        $sth->bindValue(':lastname', $this->lastname);
        $sth->bindValue(':firstname', $this->firstname);
        $sth->bindValue(':birthdate', $this->birthdate);
        $sth->bindValue(':phone', $this->phone);
        $sth->bindValue(':mail', $this->mail);
        $sth->execute();
        // on vérifie si l'ajout a bien été effectué :
        $nbResults=$sth->rowCount();
        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return($nbResults > 0) ? true : false ;
    }


    // Afficher tous les clients.

    public static function getAll(): array
    {
        $db = dbConnect();
        $sql = 'SELECT * FROM `patients` ORDER BY `lastname`;';
        $sth = $db->query($sql);
        $results = $sth->fetchAll();
        return $results;
    }

    // vérifier si le mail existe déjà dans la base de données :
    public static function exists(string $mail)
    {
        $db = dbConnect();
        $sql = 'SELECT `id` FROM `patients` WHERE `mail` = ?;';
        $sth = $db->prepare($sql);
        $sth->execute([$mail]);
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }

    // Afficher les informations du patient sélectionné (loupe) en récupérant l'id:

    public static function get($id): object
    {
        // je me connecte à la base de données
        $db = dbConnect();
        // je formule ma requête affiche tout de la table liste concernant l'id récupéré
        $sql = 'SELECT * FROM `patients` WHERE `id`=:id';
        // on prépare la requête
        $sth = $db->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        // on exécute la requête
        $sth->execute();
        // On stocke le résultat dans un objet puisque paramétrage effectué:
        $results = $sth->fetch();
        // que l'on retourne en sortie de méthode
        return $results;
    }

    // // Update :

    public function update($id)
    {
        //On se connecte à la BDD
        $db = dbConnect();

        //On insère les données reçues   
        //  on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur
        $sth = $db->prepare("
         UPDATE `patients` SET `lastname`=:lastname, `firstname`=:firstname, `birthdate`=:birthdate, `phone`=:phone, `mail`=:mail WHERE `id`=:id;");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->bindValue(':lastname', $this->lastname);
        $sth->bindValue(':firstname', $this->firstname);
        $sth->bindValue(':birthdate', $this->birthdate);
        $sth->bindValue(':phone', $this->phone);
        $sth->bindValue(':mail', $this->mail);

        return $sth->execute();
    }
}
