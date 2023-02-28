<main class="rdv d-flex flex-column justify-content-center align-items-center py-5">
    <div method="post" class="form p-4 d-flex flex-column justify-content-center align-items-center">
        <div class="datehour p-2 d-flex justify-content-between align-items-center">
            <p>Date/Heure :</p>
            <p><?= $appointment->dateHour ?></p>
        </div>
        <div class="lastname  p-2 d-flex justify-content-between align-items-center">
            <p>Nom :</p>
            <p><?= $appointment->lastname ?></p>
        </div>
        <div class="firstname  p-2 d-flex justify-content-between align-items-center">
            <p>Prénom :</p>
            <p><?= $appointment->firstname ?></p>
        </div>
        <div class="phone  p-2 d-flex justify-content-between align-items-center">
            <p>Téléphone :</p>
            <p><?= $appointment->phone ?></p>
        </div>
        <div class="mail  p-2 d-flex justify-content-between align-items-center">
            <p>Mail :</p>
            <p><?= $appointment->mail ?></p>
        </div>
        <div class="btnPen text-center p-2 text-center" id="pen">
            <img src="/public/assets/img/pen.png" alt="crayon" class="pen py-2">
        </div>
</div>
</main>