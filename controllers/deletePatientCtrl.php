<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');

require_once(__DIR__ . '/../models/Patient.php');






include(__DIR__ . '/../views/templates/header.php');

if (empty($id)) {
    include(__DIR__ . '/../views/patient/patientListCtrl.php');
} else {
    include(__DIR__ . '/../views/patient/patientProfil.php');
}

include(__DIR__ . '/../views/templates/footer.php');