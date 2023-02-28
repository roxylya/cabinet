<main class="rdv d-flex flex-column justify-content-center align-items-center py-5 my-3">
    <div method="post" class="form p-4 d-flex flex-column justify-content-center align-items-center my-5">
        <div class="patient  p-2 d-flex justify-content-between align-items-center">
            <p>Date/Heure :</p>
            <p><?= date('d-m-Y h:i', strtotime($appointment->dateHour)) ?></p>
        </div>
        <div class="patient p-2 d-flex justify-content-between align-items-center">
            <p>Patient :</p>
            <p><?= $appointment->lastname . ' '. $appointment->firstname ?></p>
        </div>
        <div class="patient p-2 d-flex justify-content-between align-items-center">
            <p>Téléphone :</p>
            <p><?= $appointment->phone ?></p>
        </div>
        <div class="patient p-2 d-flex justify-content-between align-items-center">
            <p>Mail :</p>
            <p><?= $appointment->mail ?></p>
        </div>
        <div class="btnPen text-center p-2 text-center" id="pen">
            <img src="/public/assets/img/pen.png" alt="crayon" class="pen py-2">
        </div>
</div>
</main>
