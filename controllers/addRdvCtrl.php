<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');

// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');

// on accède à la classe :
require_once(__DIR__ . '/../models/Patient.php');

// on accède à la classe :
require_once(__DIR__ . '/../models/Appointment.php');


// je crée un tableau où se trouveront tous les messages d'erreur :
$alert = [];

// je récupère la valeur de l'ID avec GET et je le nettoie, je le récupère dans une variable une fois propre :
$id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));



// je teste si mon code fonctionne :
try {
    // je récupère la liste des patients pour obtenir les noms et prénom dans le select :
    $patients = Patient::getAll();


    // Nettoyage et validation du formulaire reçu en post :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer et valider le patient :

        // filtre le nom récupéré en post:
        $idPatients = filter_input(INPUT_POST, 'idPatients', FILTER_SANITIZE_NUMBER_INT);

        // si pas de patient entré :
        if (empty($idPatients)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['idPatients'] = 'Veuillez sélectionner un patient dans la liste.';
        }
        // else {
        //     // je vérifie si l'idPatients existe dans la base de données comme id de la table patient
        //     // $patient=Patient::existsIdPatients($idPatients);
        //     // if (!$patient=Patient::existsIdPatients($idPatients)){
        //     //     // si le patient ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
        //     //     $alert['idPatients'] = 'Patient inexistant.';
        //     // }
        // }

        // Nettoyer et valider la date :

        // enlève les espaces, et filtre la date récupéré en post:
        $dateAppointment = trim(filter_input(INPUT_POST, 'dateAppointment', FILTER_SANITIZE_NUMBER_INT));

        // si pas de date entrée :
        if (empty($dateAppointment)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['dateAppointment'] = 'Veuillez sélectionner la date du rdv.';
        } else {
            // je vérifie si la date correspond à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($dateAppointment, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_DATE . '/')))) {
                // si la date ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['dateAppointment'] = 'Veuillez respecter le format.';
            } else {
                if ($dateAppointment > date('Y-m-d', strtotime('+1 year')) || $dateAppointment < date('Y-m-d')) {
                    $alert['dateAppointment'] = 'La date du rendez-vous doit être comprise entre aujourd\'hui et an+1.';
                }
                // if ($dateAppointment = date('') ) {
                //     $alert['dateAppointment'] = 'Le cabinet est fermé le dimanche.';
                // }
            }
        }

        // Nettoyer et valider l'heure :

        // enlève les espaces, et filtre l'heure récupérée en post:
        $hour = trim(filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_NUMBER_INT));

        // si pas d'heure entrée :
        if (empty($hour)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['hour'] = 'Veuillez entrer l\'heure du rdv.';
        } else {
            // je vérifie si l'heure correspond à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($hour, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_HOUR . '/')))) {
                // si l'heure ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['hour'] = 'Les rdv doivent être pris de 9h à 17h30, par tranche de 30 minutes.';
            }
        }

        // Nettoyer et valider les minutes :

        // enlève les espaces, et filtre l'heure récupérée en post:
        $minut = trim(filter_input(INPUT_POST, 'minut', FILTER_SANITIZE_NUMBER_INT));

        // si pas de minute entrée :
        if (empty($minut)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['minut'] = 'Veuillez entrer l\'heure du rdv.';
        } else {
            // je vérifie si les minutes correspondent à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($minut, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_MINUT . '/')))) {
                // si l'entrée ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['minut'] = 'Les rdv doivent être pris de 9h à 17h30, par tranche de 30 minutes.';
            }
        }

        // si le tableau alert est vide :
        if (empty($alert)) {

            // si l'id n'est pas récupéré dans le GET :
            if (empty($id)) {
                $dateHour = $dateAppointment . ' ' . $hour . ':' . $minut;
                $idPatients = intval(filter_input(INPUT_POST, 'idPatients', FILTER_SANITIZE_NUMBER_INT));
                // je crée un nouveau élément de la classe Appointment:
                $appointment = new Appointment();
                // je lui donne les valeurs récupérées, nettoyées et validées :
                $appointment->setDateHour($dateHour);
                $appointment->setIdPatients($idPatients);
                // Ajouter l'enregistrement du nouveau rdv à la base de données :
                $appointment->addAppointment($idPatients);
                // message de confirmation de l'ajout du rdv à la base de données :
                $messageOk = 'Nouveau RDV enregistré.';
                // je réinitialise l'affichage :
                $date = '';
                $patient = '';
                $hour = '';
                $minut = '';
            }
            // else {
            //     // je crée un nouveau élément de la classe Appointment:
            //     $appointment = new Appointment();
            //     // je lui donne les valeurs récupérées, nettoyées et validées :
            //     $appointment->setDateHour($dateHour);
            //     $appointment->setIdPatients($idPatients);
            //     // Ajouter l'enregistrement du nouveau RDV à la base de données :
            //     $appointment->update($id);
            //     // message de confirmation de l'ajout du RDV à la base de données :
            //     $messageOk = 'Les données du RDV ont été modifiées.';
            // }
        }
    }
    // if (!empty($id)) {
    //     // j'utilise la méthode statique pour afficher le rdv en fonction de l'id récupéré :
    //     $appointment = Appointment::get($id);
    // }

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
