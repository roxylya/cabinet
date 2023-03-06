<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/Patient.php');


try {
    // Nettoyage et validation du formulaire reçu en post :
    $research = trim((string)filter_input(INPUT_GET, 'research', FILTER_SANITIZE_SPECIAL_CHARS));
    $patients = Patient::getAll($research);

    // pagination
    // définir les variables :$pageNb $page 
    // $limite= $limit (le nombre de patient à afficher par page), $nombredElementsTotal=$patientsNb (nombre de patient enregistré dans la bd)
    /* On calcule le nombre de pages */
    $pageNb = ceil($patientsNb / $limit);
    
} catch (\Throwable $th) {
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/templates/header.php');
    include(__DIR__ . '/../views/error.php');
    include(__DIR__ . '/../views/templates/footer.php');
    die;
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/patient/patientsList.php');
include(__DIR__ . '/../views/templates/footer.php');
