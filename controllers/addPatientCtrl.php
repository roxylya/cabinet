<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/Patient.php');


// je crée un tableau où se trouveront tous les messages d'erreur :
$alert = [];

// je récupère la valeur de l'ID avec GET et je le nettoie, je le récupère dans une variable une fois propre :
$id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));


// je teste si mon code fonctionne je :
try {

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
                        $alert['mail'] = 'Mail déjà existant.'; }
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



        // si le tableau alert est vide :
        if (empty($alert)) {
            // si l'id n'est pas récupéré dans le GET :
            if (empty($id)) {
                // je crée un nouveau élément de la classe Patient:
                $patient = new Patient();
                // je lui donne les valeurs récupérées, nettoyées et validées :
                $patient->setLastname($lastname);
                $patient->setFirstname($firstname);
                $patient->setMail($mail);
                $patient->setPhone($phone);
                $patient->setBirthdate($birthdate);
                // Ajouter l'enregistrement du nouveau patient à la base de données :
                $patient->add();
                // message de confirmation de l'ajout du patient à la base de données :
                $messageOk = 'Nouveau patient enregistré.';
                // je réinitialise l'affichage :
                $firstname = '';
                $lastname = '';
                $birthdate = '';
                $phone = '';
                $mail = '';
            } else {
                // je crée un nouveau élément de la classe Patient:
                $patient = new Patient();
                // je lui donne les valeurs récupérées, nettoyées et validées :
                $patient->setLastname($lastname);
                $patient->setFirstname($firstname);
                $patient->setMail($mail);
                $patient->setPhone($phone);
                $patient->setBirthdate($birthdate);
                // Ajouter l'enregistrement du nouveau patient à la base de données :
                $patient->update($id);
                // message de confirmation de l'ajout du patient à la base de données :
                $messageOk = 'Les données du patient ont été modifiées.';
            }
        }
    }
    if (!empty($id)) {
        // j'utilise la méthode statique pour afficher le profil en fonction de l'id récupéré :
        if ($patient = Patient::get($id) == false) {
            include(__DIR__ . '/../controllers/error404Ctrl.php');
            die;
        } else {
            $patient = Patient::get($id);
            $patientRdv = Patient::getApp($id);
        }
    }
} catch (\Throwable $th) {
    // Si ça ne marche pas afficher la page d'erreur avec le message d'erreur indiquant la raison :
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
