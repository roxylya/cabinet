<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on accède à la classe :
require_once(__DIR__ . '/../models/Patient.php');
// on accède à la classe :
require_once(__DIR__ . '/../models/Appointment.php');



// je teste si mon code fonctionne :
try {
    // je récupère la valeur de l'ID avec GET et je le nettoie, je le récupère dans une variable une fois propre :
    $idAppointment = intval(filter_input(INPUT_GET, 'idAppointment', FILTER_SANITIZE_NUMBER_INT));
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $patient = Patient::delete($id);
    if ($appointment) {
        $message = 'Le patient a été supprimé.';
    } else {
        $message = 'Le patient n\'existe pas.';   
    }
    header('location: /controllers/patientListCtrl.php?message=' . $message);
        die;
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}
