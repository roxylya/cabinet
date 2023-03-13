<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/Database.php');
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
        //On insère les données reçues   
        // on note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur
        $sth = Database::getInstance()->prepare('INSERT INTO `appointments`(`dateHour`,`idPatients`) VALUES(:dateHour, :idPatients)');
        $sth->bindValue(':dateHour', $this->dateHour);
        $sth->bindValue(':idPatients', $idPatient);
        $sth->execute();
        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();
        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }



    // Afficher tous les rendez-vous.

    public static function getAllAppointments($id = NULL): array
    {
        $sql = 'SELECT `appointments`.`id` as `idAppointment`, `appointments`.`dateHour`, `patients`.`id` as `idPatient`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`phone`, `patients`.`mail`, `patients`.`birthdate` 
        FROM `appointments` 
        JOIN `patients` 
        ON `appointments`.`idPatients`= `patients`.`id` ';
        if ($id) {
            $sql .= ' WHERE `idPatients`=:id';
        }
        $sql .= ' ORDER BY `dateHour`;';

        // je fais appel à la méthode prepare qui me renvoie la réponse de ma requête,je stocke la réponse dans la variable $sth qui est un pdo statement:
        $sth = Database::getInstance()->prepare($sql);
        if ($id) {
            // On affecte les valeurs au marqueur nominatif :
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
        }
        // On stocke le résultat dans un objet puisque paramétrage effectué:
        $sth->execute();
        $results = $sth->fetchAll();
        return $results;
    }

    // vérifier si l'id existe dans la base de données :
    public static function existsIdPatient(int $idPatient)
    {
        $sql = 'SELECT `id` FROM `patients` WHERE `patients`.`id` = :idPatient;';
        $sth = Database::getInstance()->prepare($sql);
        $sth->bindValue(':idPatient', $idPatient, PDO::PARAM_INT);
        $sth->execute();
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }

    // vérifier si l'horaire est déjà pris dans la base de données :
    public static function existsDateHour(string $dateHour)
    {
        $sql = 'SELECT `id` FROM `appointments` WHERE `appointments`.`dateHour` = ?;';
        $sth = Database::getInstance()->prepare($sql);
        $sth->execute([$dateHour]);
        $results = $sth->fetchAll();

        return (empty($results)) ? false : true;
    }


    // Afficher les informations d'un rendez-vous' sélectionné (loupe) en récupérant l'id:

    public static function get($idAppointment): object | bool
    {
        // je formule ma requête affiche les éléments souhaités des tables appointments et patients concernant l'id récupéré
        // je mets des as pour différencier mes id des différentes tables : à voir
        $sql = 'SELECT `appointments`.`id` AS `idAppointment`, `appointments`.`idPatients`,`appointments`.`dateHour`, `patients`.`id`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`phone`, `patients`.`mail`, `patients`.`birthdate`  
        FROM `appointments` 
        JOIN `patients` ON `appointments`.`idPatients`=`patients`.`id` 
        WHERE `appointments`.`id`=:idAppointment;';
        // on prépare la requête
        $sth = Database::getInstance()->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':idAppointment', $idAppointment, PDO::PARAM_INT);
        // on exécute la requête
        $sth->execute();
        // On stocke le résultat dans un objet puisque paramétrage effectué:
        $results = $sth->fetch();
        // que l'on retourne en sortie de méthode
        return $results;
    }

    // // Update :

    public function update($idAppointment)
    {
        // On insère les données reçues   
        // On note les marqueurs nominatifs exemple :birthdate sert de contenant à une valeur
        $sth = Database::getInstance()->prepare("
                UPDATE `appointments` SET `dateHour`=:dateHour, `idPatients`=:idPatients WHERE `appointments`.`id`=:idAppointment;");
        $sth->bindValue(':idAppointment', $idAppointment, PDO::PARAM_INT);
        $sth->bindValue(':dateHour', $this->dateHour);
        $sth->bindValue(':idPatients', $this->idPatients);
        $sth->execute();
        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();
        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }



    // Delete un rdv :

    public static function delete($idAppointment)
    {
        // je mets des as pour différencier mes id des différentes tables :
        $sql = 'DELETE FROM `appointments` 
        WHERE `appointments`.`id`=:idAppointment ;';
        // on prépare la requête
        $sth = Database::getInstance()->prepare($sql);
        // On affecte les valeurs au marqueur nominatif :
        $sth->bindValue(':idAppointment', $idAppointment, PDO::PARAM_INT);
        // on exécute la requête
        $sth->execute();
        // on vérifie si l'ajout a bien été effectué :
        $nbResults = $sth->rowCount();
        // si le nombre de ligne est strictement supérieur à 0 alors il renverra true :
        return ($nbResults > 0) ? true : false;
    }
}
