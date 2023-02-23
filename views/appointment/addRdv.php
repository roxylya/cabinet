<main>
    <h2 class="text-center pt-5">Nouveau RDV</h2>
    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
        <p class="messageOk p-2"><?= $messageOk ?? '' ?></p>
        <form method="post" class="form p-4">
            <div class="dateHour p-3">
                <label for="dateHour">Date et heure :</label>
                <input type="datetime-local" name="dateHour" id="dateHour" value="<?= $dateHour ?? '' ?>" pattern="<?= REGEX_DATEHOUR ?>" required>
                <p class="error"><?= $alert['dateHour'] ?? '' ?></p>
            </div>
            <div class="lastname p-3">
                <label for="lastname">Nom : </label>
                <input type="text" name="lastname" id="lastname" value="<?= $lastname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                <p class="error"><?= $alert['lastname'] ?? '' ?></p>
            </div>
            <div class="firstname p-3">
                <label for="firstname">Prénom : </label>
                <input type="text" name="firstname" id="firstname" value="<?= $firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                <p class="error"><?= $alert['firstname'] ?? '' ?></p>
            </div>
            <div class="btnEnvoyer text-center p-3">
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</main>