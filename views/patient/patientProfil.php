<main class="patientPatient d-flex flex-column justify-content-center align-items-center py-5">
    <p class="messageOk"><?= $messageOk ?? '' ?></p>
    <form method="post" class="form p-4">
        <div class="lastname p-3">
            <label for="lastname">Nom :</label>
            <input type="text" name="lastname" id="lastname" class="noEdit" value="<?= $patient->lastname ?>" pattern="<?= REGEX_NAME ?>" readonly>
            <p class="error"><?= $alert['lastname'] ?? '' ?></p>
        </div>
        <div class="firstname p-3">
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" id="firstname" class="noEdit" value="<?= $patient->firstname ?>" pattern="<?= REGEX_NAME ?>" readonly>
            <p class="error"><?= $alert['firstname'] ?? '' ?></p>
        </div>
        <div class="birthdate p-3">
            <label for="birthdate">Date de Naissance : </label>
            <input type="date" name="birthdate" id="birthdate" class="noEdit" value="<?= $patient->birthdate ?>" readonly>
            <p class="error"><?= $alert['birthdate'] ?? '' ?></p>
        </div>
        <div class="phone p-3">
            <label for="phone">Numéro de téléphone : </label>
            <input type="text" name="phone" id="phone" class="noEdit" value="<?= $patient->phone ?>" pattern="<?= REGEX_PHONENUMBER ?>" readonly>
            <p class="error"><?= $alert['phone'] ?? '' ?></p>
        </div>
        <div class="mail p-3">
            <label for="mail">Mail : </label>
            <input type="mail" name="mail" id="mail" class="noEdit" value="<?= $patient->mail ?>" pattern="<?= REGEX_EMAIL ?>" readonly>
            <p class="error"><?= $alert['mail'] ?? '' ?></p>
        </div>
        <div class="btnEnvoyer text-center py-3 d-flex justify-content-around align-items-center">
            <input type="submit" value="Envoyer">
            <div class="btnPen text-center ms-2" id="pen">
                <img src="/public/assets/img/pen.png" alt="crayon" class="pen py-2">
            </div>
        </div>

    </form>
</main>