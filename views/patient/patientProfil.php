<main class="patientPatient d-flex flex-column justify-content-center align-items-center py-5">
    <p class="messageOk"><?= $messageOk ?? '' ?></p>
    <form method="post" class="form p-3">
        <div class="lastname ps-2 pb-2 d-flex justify-content-between align-items-center">
            <label for="lastname">Nom :</label>
            <input type="text" name="lastname" id="lastname" class="noEdit" value="<?= $patient->lastname ?>" pattern="<?= REGEX_NAME ?>" readonly>
            <p class="error"><?= $alert['lastname'] ?? '' ?></p>
        </div>
        <div class="firstname ps-2 pb-2 d-flex justify-content-between align-items-center">
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" id="firstname" class="noEdit" value="<?= $patient->firstname ?>" pattern="<?= REGEX_NAME ?>" readonly>
            <p class="error"><?= $alert['firstname'] ?? '' ?></p>
        </div>
        <div class="birthdate ps-2 pb-2 d-flex justify-content-between align-items-center">
            <label for="birthdate">Date de Naissance : </label>
            <input type="date" name="birthdate" id="birthdate" class="noEdit" value="<?= $patient->birthdate ?>" readonly>
            <p class="error"><?= $alert['birthdate'] ?? '' ?></p>
        </div>
        <div class="phone  ps-2 pb-2 d-flex justify-content-between align-items-center">
            <label for="phone">Numéro de téléphone : </label>
            <input type="text" name="phone" id="phone" class="noEdit" value="<?= $patient->phone ?>" pattern="<?= REGEX_PHONENUMBER ?>" readonly>
            <p class="error"><?= $alert['phone'] ?? '' ?></p>
        </div>
        <div class="mail ps-2 pb-2 d-flex justify-content-between align-items-center">
            <label for="mail">Mail : </label>
            <input type="mail" name="mail" id="mail" class="noEdit" value="<?= $patient->mail ?>" pattern="<?= REGEX_EMAIL ?>" readonly>
            <p class="error"><?= $alert['mail'] ?? '' ?></p>
        </div>
        <div class="btnEnvoyer text-center pb-2 d-flex justify-content-around align-items-center">
            <input type="submit" value="Envoyer">
            <div class="btnPen text-center ms-2" id="pen">
                <img src="/public/assets/img/pen.png" alt="crayon" class="pen py-2">
            </div>
        </div>
    </form>
    <div class="rdvPatient mt-5">
        <table>
            <tr class="titleCol">
                <th>RDV</th>
            </tr>
            <tr>
                <?php if ($patientRdv == false) {
                    $noRdv = 'Aucun rdv'; ?>
                    <td><?= $noRdv; ?>
                    </td>
                    <?php } else {
                    foreach ($patientRdv as $patientRdv->dateHour) { ?>
                        <td><?= date('d-m-Y H:i', strtotime($patientRdv->dateHour)); ?>
                        </td><?php }
                        } ?>
            </tr>
        </table>
    </div>
</main>