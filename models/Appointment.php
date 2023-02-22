<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');

class Appointment{
    public int $id;
    public string $dateHour;
    public int $idPatients;
   

    public function __construct(int $id, string $dateHour, int $idPatients) {
        $this->id = $id;
        $this->dateHour = $dateHour;
        $this->idPatients = $idPatients;
    }

    public function setDateHour(string $dateHour){
        $this->dateHour = $dateHour;
    }
    public function getDateHour():string{
        return $this->dateHour;
    }
}
