<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');

// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');

// // on accède à la classe :
// require_once(__DIR__ . '/../models/Patient.php');

// on accède à la classe :
require_once(__DIR__ . '/../models/Appointment.php');


try {
    if (!empty($id)) {
        // je récupère la valeur de l'ID avec GET et je le nettoie, je le récupère dans une variable une fois propre :
        $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

        // j'utilise la méthode statique pour afficher le rdv en fonction de l'id récupéré :
        if ($appointment = Appointment::get($id) == false) {
            include(__DIR__ . '/../controllers/error404Ctrl.php');
            die;
        } else {
            $appointment = Appointment::get($id);
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/appointment/rdv.php');
include(__DIR__ . '/../views/templates/footer.php');
