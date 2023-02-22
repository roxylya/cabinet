<main>
    <h2 class="text-center pt-5">Nouveau patient</h2>
    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
        <p class="messageOk p-2"><?= $messageOk ?? '' ?></p>
        <form method="post" class="form p-4">
            <div class="lastname p-3">
                <label for="lastname">Nom :</label>
                <input type="text" name="lastname" id="lastname" value="<?= $lastname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                <p class="error"><?= $alert['lastname'] ?? '' ?></p>
            </div>
            <div class="firstname p-3">
                <label for="firstname">Prénom : </label>
                <input type="text" name="firstname" id="firstname" value="<?= $firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                <p class="error"><?= $alert['firstname'] ?? '' ?></p>
            </div>
            <div class="birthdate p-3">
                <label for="birthdate">Date de Naissance : </label>
                <input type="date" name="birthdate" id="birthdate" value="<?= $birthdate ?? '' ?>" min="" max="" required>
                <p class="error"><?= $alert['birthdate'] ?? '' ?></p>
            </div>
            <div class="phone p-3">
                <label for="phone">Numéro de téléphone : </label>
                <input type="text" name="phone" id="phone" value="<?= $phone ?? '' ?>" pattern="<?= REGEX_PHONENUMBER ?>">
                <p class="error"><?= $alert['phone'] ?? '' ?></p>
            </div>
            <div class="mail p-3">
                <label for="mail">Mail : </label>
                <input type="mail" name="mail" id="mail" value="<?= $mail ?? '' ?>" pattern="<?= REGEX_EMAIL ?>">
                <p class="error"><?= $alert['mail'] ?? '' ?></p>
            </div>
            <div class="btnEnvoyer text-center p-3">
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</main>