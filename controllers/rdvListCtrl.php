<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/Database.php');

// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');

// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/config.php');

// on accède à la classe :
require_once(__DIR__ . '/../models/Appointment.php');



// je teste si mon code fonctionne :
try {
    $code= intval(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT));
    // je récupère la liste des patients pour obtenir les noms et prénom dans le select :
    $appointments = Appointment::getAllAppointments();
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/appointment/rdvList.php');
include(__DIR__ . '/../views/templates/footer.php');

