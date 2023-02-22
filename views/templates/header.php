<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Julee&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/assets/img/hopital.png">
    <title>Hôpital</title>
</head>

<body>
    <header class="py-1">
        <!-- navbar start -->
        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid">
              <a href="/controllers/homeCtrl.php"><img class="logo ms-lg-5" src="/public/assets/img/hopital.png" alt="Logo Hôpital"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="w-100 d-flex flex-column flex-lg-row justify-content-end align-items-center navbar-nav pt-2 pt-lg-0">
                        <a class="nav-link pe-lg-5" href="/controllers/addPatientCtrl.php">Créer un patient</a>
                        <a class="nav-link pe-lg-5" href="/controllers/patientsListCtrl.php">Patientèle</a>
                        <a class="nav-link pe-lg-5" href="/controllers/addRdvCtrl.php">Ajouter un rendez-vous</a>
                        <a class="nav-link pe-lg-5" href="/controllers/rdvListCtrl.php">Agenda</a>
                        <a class="nav-link pe-lg-5" href="/controllers/addPatientAddRdvCtrl.php">Nouveau patient/rdv</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar end -->
    </header>