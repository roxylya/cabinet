<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');

require_once(__DIR__ . '/../models/Patient.php');

$alert = [];


try {
    // Nettoyage et validation du formulaire :
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Nettoyer le mail :
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
        if (empty($mail)) {
            $alert['mail'] = "Veuillez renseigner l' email.";
        } else {
            // Valider le mail :
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $alert['mail'] = "L'adresse email n'est pas valide.";
            } else {
                // // vérifier si le mail existe déjà dans la base de données : 
                // $sql = "SELECT COUNT(`id`) FROM `matable` WHERE `id` = '$mail';";
                // if ($sql > 0) {
                //     $alert['mail'] = 'Mail déjà existant.';
                // }
                if (Patient::mailExists($mail)) {
                    $alert['mail'] = 'Mail déjà existant.';
                }
            }
        }

        // Nettoyer le prénom :
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($firstname)) {
            $alert['firstname'] = 'Veuillez entrer le prénom.';
        } else {
            // Prénom correspond à la regex ?
            if (!filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')))) {
                $alert['firstname'] = 'Format incorrect.';
            } else {
                // enregistrer en base de données :
            }
        }

        // Nettoyer le nom :
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
        if (empty($lastname)) {
            $alert['lastname'] = 'Veuillez entrer le nom.';
        } else {
            // Nom correspond à la regex ?
            if (!filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')))) {
                $alert['lastname'] = 'Format incorrect.';
            } else {
                // enregistrer en base de données :
            }
        }

        // Récupérer la date :
        $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_NUMBER_INT));
        if (empty($birthdate)) {
            $alert['birthdate'] = 'Veuillez entrer la date de naissance.';
        } else {
            // Date correspond à une date existante ?
            if (!filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_DATE . '/')))) {
                $alert['birthdate'] = 'Veuillez respecter le format.';
            } else {
                //    enregistrement en base de données

            }
        }


        // Vérifier le numéro de téléphone :
        // Récupérer la numéro de tel :
        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
        if (empty($phone)) {
            $alert['phone'] = 'Veuillez entrer un numéro de téléphone.';
        } else {

            //Numéro de tel correspond à la regex ?
            if (!filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PHONENUMBER . '/')))) {
                $alert['phone'] = 'Veuillez respecter le format.';
            } else {
                // enregistrer en base de données
            }
        }
    }

    // je récupère la valeur de l'ID avec GET :
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($alert)) {
        // si l'id n'est pas récupéré dans le GET :
        if (empty($id)) {
            // Ajouter l'enregistement du nouveau patient à la base de données :
            $patient = new Patient();
            $patient->setLastname($lastname);
            $patient->setFirstname($firstname);
            $patient->setMail($mail);
            $patient->setPhone($phone);
            $patient->setBirthdate($birthdate);
            $patient->addPatient();
            $messageOk = 'Nouveau patient enregistré.';
            $firstname = '';
            $lastname = '';
            $birthdate = '';
            $phone = '';
            $mail = '';
        } else {
            $patient = Patient::get($id);
        }
    }
} catch (\Throwable $e) {
    $errorMessage = $th->getMessage();
    include(__DIR__ . '/../views/error.php');
    die;
}





include(__DIR__ . '/../views/templates/header.php');

if (empty($id)) {
    include(__DIR__ . '/../views/patient/addPatient.php');
} else {
    include(__DIR__ . '/../views/patient/patientProfil.php');
}

include(__DIR__ . '/../views/templates/footer.php');
