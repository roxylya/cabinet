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

    // pagination  
    // $limite= $limit (le nombre de patient à afficher par page) 
    $limit = 10;

    // je récupère le numéro de la page sur laquelle on se trouve
    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($page)) {
        $page = 1;
    }

    // Calcul du 1er article de la page
    $firstPatient = ($page - 1) * $limit;


    // je limite l'affichage par page :
    $patients = Patient::getAll($research, $firstPatient, $limit);

    // j'appelle ma méthode pour obtenir la liste des patients :
    $nbPatientsTotal = Patient::getAllCount($research);
    
    // On calcule le nombre de pages 
    $pageNb = ceil(count($nbPatientsTotal) / $limit);
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
