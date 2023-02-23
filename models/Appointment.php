<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// le helper :
require_once(__DIR__ . '/../helper/dd.php');

class Appointment{
    private int $id;
    private string $dateHour;
    private int $idPatients;
   

    public function __construct(int $id, string $dateHour, int $idPatients) {
        $this->id = $id;
        $this->dateHour = $dateHour;
        $this->idPatients = $idPatients;
    }

    public function setId(int $id){
        $this->id = $id;
    }
    public function getId():int{
        return $this->id;
    }

    public function setDateHour(string $dateHour){
        $this->dateHour = $dateHour;
    }
    public function getDateHour():string{
        return $this->dateHour;
    }

    public function setIdPatients(int $idPatients){
        $this->dateHour = $idPatients;
    }
    public function getIdPatients():int{
        return $this->idPatients;
    }
}
