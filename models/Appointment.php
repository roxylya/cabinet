<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

// // la classe Patient :
// require_once(__DIR__ . '/../models/Patient.php');

class Appointment
{
    private int $id;
    private string $dateHour;
    private int $idPatients;


    // public function __construct(string $dateHour, int $idPatients)
    // {

    //     $this->dateHour = $dateHour;
    //     $this->idPatients = $idPatients;
    // }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setDateHour(string $dateHour)
    {
        $this->dateHour = $dateHour;
    }
    public function getDateHour(): string
    {
        return $this->dateHour;
    }

    public function setIdPatients(int $idPatients)
    {
        $this->idPatients = $idPatients;
    }
    public function getIdPatients(): int
    {
        return $this->idPatients;
    }



    // ajouter un rendez-vous

    public function addAppointment($idPatient)
    {

        //On se connecte à la BDD
        $db = dbConnect();

        //On insère les données reçues   
        // on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur
        $sth = $db->prepare('INSERT INTO `appointments`(`dateHour`,`idPatients`) VALUES(:dateHour, :idPatients)');
        $sth->bindValue(':dateHour', $this->dateHour);
        $sth->bindValue(':idPatients', $idPatient);
        $sth->execute();
        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();
        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }



    // Afficher tous les rendez-vous.

    public static function getAllAppointments(): array
    {
        $db = dbConnect();
        $sql = 'SELECT `appointments`.`id` as `idAppointment`, `appointments`.`dateHour`, `patients`.`id` as `idPatient`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`phone`, `patients`.`mail`, `patients`.`birthdate` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients`= `patients`.`id` ORDER BY `dateHour`;';
        $sth = $db->query($sql);
        $results = $sth->fetchAll();
        return $results;
    }

    // vérifier si l'id existe dans la base de données :
    public static function existsIdPatient(int $idPatient)
    {
        $db = dbConnect();
        $sql = 'SELECT `id` FROM `patients` WHERE `patients`.`id` = :idPatient;';
        $sth = $db->prepare($sql);
        $sth->execute([$idPatient]);
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }


    // Afficher les informations d'un rendez-vous' sélectionné (loupe) en récupérant l'id:

    public static function get($idAppointment): object
    {
        // je me connecte à la base de données
        $db = dbConnect();
        // je formule ma requête affiche les éléments souhaités des tables appointments et patients concernant l'id récupéré
        // je mets des as pour différencier mes id des différentes tables : à voir
        $sql = 'SELECT `appointments`.`id`, `appointments`.`dateHour`, `patients`.`id`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`phone`, `patients`.`mail`, `patients`.`birthdate`  FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients`=`patients`.`id` WHERE `appointments`.`id`=:idAppointment ORDER BY `dateHour`';
        // on prépare la requête
        $sth = $db->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':idAppointment', $idAppointment, PDO::PARAM_INT);
        // on exécute la requête
        $sth->execute();
        // On stocke le résultat dans un objet puisque paramétrage effectué:
        $results = $sth->fetch();
        // que l'on retourne en sortie de méthode
        return $results;
    }

    //     // // Update :

    //     public function update($id)
    //     {
    //         //On se connecte à la BDD
    //         $db = dbConnect();

    //         //On insère les données reçues   
    //         //  on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur
    //         $sth = $db->prepare("
    //             UPDATE `appointments` SET `dateHour`=:dateHour, `idPatients`=:idPatients, WHERE `id`=:id;");
    //         $sth->bindValue(':id', $id, PDO::PARAM_INT);
    //         $sth->bindValue(':dateHour', $this->dateHour);
    //         $sth->bindValue(':idPatients', $this->idPatients);


    //         return $sth->execute();
    //     }
}
