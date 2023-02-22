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

    public function __construct()
    {
        // string $lastname, string $firstname, string $birthdate, string $phone, string $mail
        // $this->lastname = $lastname;
        // $this->firstname = $firstname;
        // $this->birthdate = $birthdate;
        // $this->phone = $phone;
        // $this->mail = $mail;
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


    public function addPatient()
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

        return $sth->execute();
    }


    // Afficher tous les clients.

    public static function getPatients(): array
    {
        $db = dbConnect();
        $sql = 'SELECT * FROM `patients` ORDER BY `lastname`;';
        $sth = $db->query($sql);
        $results = $sth->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    // vérifier si le mail existe déjà dans la base de données :
    public static function mailExists(string $mail)
    {
        $db = dbConnect();
        $sql = 'SELECT `id` FROM `patients` WHERE `mail` = ?;';
        $sth = $db->prepare($sql);
        $sth->execute([$mail]);
        $results = $sth->fetchAll(PDO::FETCH_OBJ);

        return (empty($results)) ? false : true;
    }

    // Afficher les informations du patient sélectionné (loupe) en récupérant l'id:

    public static function getProfilPatient(): array
    {
        $db = dbConnect();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT * FROM `patients`  WHERE `id` = $id";
        $sth = $db->prepare($sql);
        // On attache les valeurs
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetch(PDO::FETCH_OBJ);
        return $results;
    }


    public static function updatePatient()
    {
        //On se connecte à la BDD
        $db = dbConnect();

        //On insère les données reçues   
        // $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
        //  on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur
        $sth = $db->prepare("
         UPDATE `liste` SET `produit`=:produit, `prix`=:prix, `nombre`=:nombre WHERE `id`=:id;");
        $sth->bindValue(':lastname', $lastname);
        $sth->bindValue(':firstname', $firstname);
        $sth->bindValue(':birthdate', $birthdate);
        $sth->bindValue(':phone', $phone);
        $sth->bindValue(':mail', $mail);

        return $sth->execute();
    }
}
