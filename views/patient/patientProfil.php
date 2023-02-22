<main class="profilPatient d-flex flex-column justify-content-center align-items-center py-5">
        <form method="post" class="form p-4">
            <div class="lastname p-3">
                <label for="lastname">Nom :</label>
                <input type="text" name="lastname" id="lastname" value="<?= $patient->lastname ?>" pattern="<?= REGEX_NAME ?>" readonly>
                <p class="error"><?= $alert['lastname'] ?? '' ?></p>
            </div>
            <div class="firstname p-3">
                <label for="firstname">Prénom : </label>
                <input type="text" name="firstname" id="firstname" value="<?= $patient->firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>"  readonly>
                <p class="error"><?= $alert['firstname'] ?? '' ?></p>
            </div>
            <div class="birthdate p-3">
                <label for="birthdate">Date de Naissance : </label>
                <input type="date" name="birthdate" id="birthdate" value="<?= $patient->birthdate ?? '' ?>" min="" max=""  readonly>
                <p class="error"><?= $alert['birthdate'] ?? '' ?></p>
            </div>
            <div class="phone p-3">
                <label for="phone">Numéro de téléphone : </label>
                <input type="text" name="phone" id="phone" value="<?= $patient->phone ?? '' ?>" pattern="<?= REGEX_PHONENUMBER ?>" readonly>
                <p class="error"><?= $alert['phone'] ?? '' ?></p>
            </div>
            <div class="mail p-3">
                <label for="mail">Mail : </label>
                <input type="mail" name="mail" id="mail" value="<?= $patient->mail ?? '' ?>" pattern="<?= REGEX_EMAIL ?>"  readonly>
                <p class="error"><?= $alert['mail'] ?? '' ?></p>
            </div>
            <div class="btnEnvoyer text-center p-3">
                <input type="submit" value="Envoyer">
            </div>
        </form>


        <!-- <div class="formProfil mb-5 d-flex flex-column">
            <h2 class="text-center mt-3 py-3"></h2>
            <div class="d-flex flex-column mb-3">
                <img src="/public/assets/img/pen.png" alt="crayon" class="pen">
                <div class="infosPatient d-flex justify-content-between">
                    <p class="propriety pe-3">Date de naissance :</p>
                    <p> </p>
                </div>
                <div class="infosPatient d-flex justify-content-between ">
                    <p class="propriety pe-3">Téléphone :</p>
                    <p></p>
                </div>
                <div class="infosPatient d-flex justify-content-between">
                    <p class="propriety pe-3">Mail :</p>
                    <p> </p>
                </div>
            </div>
        </div>  -->
</main>