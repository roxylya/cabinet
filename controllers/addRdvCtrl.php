<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');

// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');

// on accède à la classe :
require_once(__DIR__ . '/../models/Appointment.php');


// je crée un tableau où se trouveront tous les messages d'erreur :
$alert = [];

// je récupère la valeur de l'ID avec GET et je le nettoie, je le récupère dans une variable une fois propre :
$id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));


// je teste si mon code fonctionne :
try {

    // Nettoyage et validation du formulaire reçu en post :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        // Nettoyer et valider le prénom :

        // enlève les espaces, et filtre le prénom récupéré en post:
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));

        // si pas de prénom entré :
        if (empty($firstname)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['firstname'] = 'Veuillez entrer le prénom.';
        } else {
            // je vérifie si le prénom correspond à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')))) {
                // si le prénom ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['firstname'] = 'Format incorrect.';
            }
        }


        // Nettoyer et valider le nom :

        // enlève les espaces, et filtre le nom récupéré en post:
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));

        // si pas de nom entré :
        if (empty($lastname)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['lastname'] = 'Veuillez entrer le nom.';
        } else {
            // je vérifie si le nom correspond à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')))) {
                // si le prénom ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['lastname'] = 'Format incorrect.';
            }
        }

        // Nettoyer et valider la date :

        // enlève les espaces, et filtre la date récupéré en post:
        $dateHour = trim(filter_input(INPUT_POST, 'dateHour', FILTER_SANITIZE_SPECIAL_CHARS));

        // si pas de date entrée :
        if (empty($dateHour)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['dateHour'] = 'Veuillez entrer la date de naissance.';
        } else {
            // je vérifie si la date correspond à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($dateHour, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_DATEHOUR . '/')))) {
                // si la date ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['dateHour'] = 'Veuillez respecter le format.';
            }
        }


        // si le tableau alert est vide :
        if (empty($alert)) {
            // si l'id n'est pas récupéré dans le GET :
            if (empty($id)) {
                // je crée un nouveau élément de la classe Appointment:
                $appointment = new Appointment();
                // je lui donne les valeurs récupérées, nettoyées et validées :
                $appointment->setDateHour($dateHour);
                $appointment->setIdPatients($idPatients);
            
                
                // Ajouter l'enregistrement du nouveau rdv à la base de données :
                $appointment->add();
                // message de confirmation de l'ajout du rdv à la base de données :
                $messageOk = 'Nouveau RDV enregistré.';
                // je réinitialise l'affichage :
                $firstname = '';
                $lastname = '';
                $dateHour = '';
            } else {
                // je crée un nouveau élément de la classe Appointment:
                $appointment = new Appointment();
                // je lui donne les valeurs récupérées, nettoyées et validées :
                $appointment->setDateHour($dateHour);
                $appointment->setIdPatients($idPatients);
                // Ajouter l'enregistrement du nouveau RDV à la base de données :
                $appointment->update($id);
                // message de confirmation de l'ajout du RDV à la base de données :
                $messageOk = 'Les données du RDV ont été modifiées.';
            }
        }
    }
    if (!empty($id)) {
        // j'utilise la méthode statique pour afficher le rdv en fonction de l'id récupéré :
        $appointment = Appointment::get($id);
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}





include(__DIR__ . '/../views/templates/header.php');

if (empty($id)) {
    include(__DIR__ . '/../views/appointment/addRdv.php');
} else {
    include(__DIR__ . '/../views/appointment/rdv.php');
}

include(__DIR__ . '/../views/templates/footer.php');