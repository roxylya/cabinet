<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/Database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/Patient.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/Appointment.php');


// je teste si mon code fonctionne :
try {

    // je crée un tableau où se trouveront tous les messages d'erreur :
    $alert = [];

    // Nettoyage et validation du formulaire reçu en post :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer et valider le mail :

        // enlève les espaces, et filtre le mail récupéré en post
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));

        // si pas de mail entré :
        if (empty($mail)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['mail'] = "Veuillez renseigner l' email.";
        } else {
            // Valider le mail :
            // si le mail ne correpond pas à ce qui est attendu d'un mail :
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                // j'ajoute le message d'erreur au tableau alert :
                $alert['mail'] = "L'adresse email n'est pas valide.";
            } else {
                // Si le mail est validé :  
                // je vérifie si le mail n'est pas déjà présent en base de données et que le mail n'est pas déjà celui de l'id en cours d'affichage :
                if (empty($id)) {
                    if (patient::existsMail($mail)) {
                        $alert['mail'] = 'Mail déjà existant.';
                    }
                } else {
                    $patient = Patient::get($id);
                    if (Patient::existsMail($mail) && $mail != $patient->mail) {
                        // si le mail existe j'ajoute le message d'erreur au tableau d'alert :
                        $alert['mail'] = 'Mail déjà existant.';
                    }
                }
            }
        }


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


        // Nettoyer et valider la date de naissance :

        // enlève les espaces, et filtre la date récupéré en post:
        $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT));

        // si pas de date entrée :
        if (empty($birthdate)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['birthdate'] = 'Veuillez entrer la date de naissance.';
        } else {
            // je vérifie si la date correspond à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_DATE . '/')))) {
                // si la date ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['birthdate'] = 'Veuillez respecter le format.';
            } else {
                if ($birthdate < date('Y-m-d', strtotime('-130 years')) || $birthdate > date('Y-m-d')) {
                    $alert['birthdate'] = 'AH OUI ?!';
                }
            }
        }


        // Nettoyer et valider le numéro de téléphone :

        // enlève les espaces, et filtre le numéro de téléphone récupéré en post:
        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));

        // si pas de numéro entré :
        if (empty($phone)) {
            // j'ajoute le message d'erreur au tableau alert :
            $alert['phone'] = 'Veuillez entrer un numéro de téléphone.';
        } else {
            // je vérifie si le numéro correspond à la regex (qui est une constante définie dans constants.php)
            if (!filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PHONENUMBER . '/')))) {
                // si le numéro ne correspond pas, j'ajoute le message d'erreur au tableau d'alert :
                $alert['phone'] = 'Veuillez respecter le format.';
            }
        }
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


        // Vérifier que le rdv n'est pas déjà réservé :
        if (empty($idAppointment)) {
            $dateHour = $dateAppointment . ' ' . $hour . ':' . $minut;

            if (Appointment::existsDateHour($dateHour)) {
                $alert['dateAppointment'] = 'Ce rendez-vous est déjà pris.';
            }
        } else {
            $dateHour = $dateAppointment . ' ' . $hour . ':' . $minut . ':00';
            if (Appointment::existsDateHour($dateHour) && $idAppointment != $appointment->idAppointment) {
                $alert['dateAppointment'] = 'Ce rendez-vous est déjà pris.';
            }
        }

        // si le tableau alert est vide :
        if (empty($alert)) {
        
            // $db->beginTransaction();

            // Pour la partie Client :
            // je crée un nouveau élément de la classe Patient:
            $patient = new Patient();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $patient->setLastname($lastname);
            $patient->setFirstname($firstname);
            $patient->setMail($mail);
            $patient->setPhone($phone);
            $patient->setBirthdate($birthdate);

            // Ajouter l'enregistrement du nouveau patient à la base de données :
            $isAddedPatient = $patient->add();

            // je récupère l'id du patient nouvellement crée dans la base de données, j'utilise le mail qui est unique à chaque patient :
            $patient = Patient::getIdPatient($mail);
            $idPatient = $patient->id;
            //    pour la partie rdv :
            // je crée un nouveau élément de la classe Appointment:
            $appointment = new Appointment();
            // je lui donne les valeurs récupérées, nettoyées et validées :
            $appointment->setDateHour($dateHour);
            $appointment->setIdPatients($idPatient);
            // Ajouter l'enregistrement du nouveau rdv à la base de données :
            $isAddedAppointment = $appointment->addAppointment($idPatient);
            $isAddedAppointment = false;
            if ($isAddedPatient == true && $isAddedAppointment == true) {
                   /* Commit the changes */
                //    $db->commit();
            // } else {
            //     $db->rollBack();
            //     if($isAddedAppointment == false && $isAddedPatient == false){
            //         throw new Exception('Des informations manquent sur le rendez-vous et sur le patient.'); 
            //      }
            //     if($isAddedAppointment == false){
            //        throw new Exception('Des informations manquent sur le rendez-vous.'); 
            //     }
            //     if($isAddedPatient == false){
            //         throw new Exception('Des informations manquent sur le patient.'); 
            //     }
                
            }

            // si tout est bon :
            // message de confirmation de l'ajout du patient à la base de données :
            $messageOk = 'Nouveau patient et RDV enregistrés.';

            // je réinitialise l'affichage : 
            $firstname = '';
            $lastname = '';
            $birthdate = '';
            $phone = '';
            $mail = '';
            $dateAppointment = '';
            $patient = '';
            $hour = '';
            $minut = '';
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/patient/addPatientAddRdv.php');
include(__DIR__ . '/../views/templates/footer.php');
