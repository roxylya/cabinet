<?php
// on a besoin d'accéder à la db :
require_once(__DIR__ . '/../models/database.php');
// on a besoin d'accéder aux constantes :
require_once(__DIR__ . '/../config/constants.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/Patient.php');
// on a besoin du models :
require_once(__DIR__ . '/../models/Appointment.php');


include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/patient/addPatientAddRdv.php');
include(__DIR__ . '/../views/templates/footer.php');
