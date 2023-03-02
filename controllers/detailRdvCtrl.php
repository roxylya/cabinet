<?php
// on accède à la classe :
require_once(__DIR__ . '/../models/Appointment.php');
try {
    $idAppointment = abs(intval(filter_input(INPUT_GET, 'idAppointment', FILTER_SANITIZE_NUMBER_INT)));
    $appointment = Appointment::get($idAppointment);
    if (!$appointment) {
        throw new Exception('Le rendez-vous est introuvable.');
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/error.php');
    include(__DIR__ . '/../views/templates/footer.php');
    die;
}








include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/appointment/detailRdv.php');
include(__DIR__ . '/../views/templates/footer.php');
