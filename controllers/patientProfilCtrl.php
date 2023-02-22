<?php

// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
$alert = [];
require_once(__DIR__ . '/../models/Patient.php');




$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
// $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
// $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
// $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT);
// $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
// $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);



try {
    $patient = Patient::get($id);
} catch (\Throwable $th) {
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}
include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/patient/patientProfil.php');
include(__DIR__ . '/../views/templates/footer.php');

// $patient = Patient::updatePatient($id);