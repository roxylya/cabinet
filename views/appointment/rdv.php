<main>
    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
    <h2 class="text-center pt-5">Rendez-vous</h2> 
        <p class="messageOk p-2"><?= $messageOk ?? '' ?></p>
        <form method="post" class="form p-4">
            <div class="date p-3">
                <label for="dateAppointment">Date :</label>
                <input class="noEdit" type="date" name="dateAppointment" id="dateAppointment" value="<?= $dateAppointment ?? date('Y-m-d', strtotime($appointment->dateHour)) ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+1 year')) ?>" pattern="<?= REGEX_DATE ?>" readonly>
                <p class="error"><?= $alert['dateAppointment'] ?? '' ?></p>
            </div>
            <div class="hourMinut p-3">
                <label for="hour">Heure :</label>
                <div class="d-flex justify-content-around align-items-center">
                    <select class="noEdit" name="hour" id="hour-select" disabled>
                    <?php $hourToDisplay = $hour ?? date('h', strtotime($appointment->dateHour)) ?>
                        <option <?= ($hourToDisplay=='09') ? 'selected' : ''?>>09</option>
                        <option <?= ($hourToDisplay=='10') ? 'selected' : ''?>>10</option>
                        <option <?= ($hourToDisplay=='11') ? 'selected' : ''?>>11</option>
                        <option <?= ($hourToDisplay=='12') ? 'selected' : ''?>>12</option>
                        <option <?= ($hourToDisplay=='13') ? 'selected' : ''?>>13</option>
                        <option <?= ($hourToDisplay=='14') ? 'selected' : ''?>>14</option>
                        <option <?= ($hourToDisplay=='15') ? 'selected' : ''?>>15</option>
                        <option <?= ($hourToDisplay=='16') ? 'selected' : ''?>>16</option>
                        <option <?= ($hourToDisplay=='17') ? 'selected' : ''?>>17</option>
                    </select>
                    <select class="noEdit" name="minut" id="minut-select" disabled>
                        <?php $minutToDisplay = $minut ?? date('i', strtotime($appointment->dateHour)) ?>
                        <option <?= ($minutToDisplay=='00') ? 'selected' : ''?>>00</option>
                        <option <?= ($minutToDisplay=='30') ? 'selected' : ''?>>30</option>
                    </select>
                </div>
                <p class="error"><?= $alert['hour'] ?? '' ?></p>
            </div>
            <div class="p-3">
                <label for="idPatient">Patient : </label>
                <select class="patient noEdit" name="idPatient" id="idPatient" disabled>
                    <?php foreach ($patients as $patient) { 
                        $patientId= $idPatient ?? $patient->id;?>
                        <?= '<option value="' . $patient->id . '" '. (($patientId == $appointment->idPatients) ? 'selected' : '') .'>' . (($patient->lastname . ' ' . $patient->firstname)  ??  ($lastname . ' ' . $firstname)) .' </option>'; ?>
                    <?php } ?>
                </select>
                <p class="error"><?= $alert['idPatient'] ?? '' ?></p>
            </div>
            <div class="btnEnvoyer text-center py-3 d-flex justify-content-around align-items-center">
                <input type="submit" value="Envoyer">
                <div class="btnPen text-center ms-2" id="pen">
                    <img src="/public/assets/img/pen.png" alt="crayon" class="pen py-2">
                </div>
            </div>
        </form>
        <div class="br py-4">

        </div>
    </div>
</main>