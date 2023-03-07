<main>
<h2 class="text-center pt-5">RDV pour un nouveau Patient</h2>
    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
        <p class="messageOk p-2"><?= $messageOk ?? '' ?></p>
        <form method="post" class="form p-4">
            <h3 class="text-center pb-2">Patient</h3>
            <div class="lastname pb-2">
                <label for="lastname">Nom :</label>
                <input type="text" name="lastname" id="lastname" value="<?= $lastname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                <p class="error"><?= $alert['lastname'] ?? '' ?></p>
            </div>
            <div class="firstname pb-2">
                <label for="firstname">Prénom : </label>
                <input type="text" name="firstname" id="firstname" value="<?= $firstname ?? '' ?>" pattern="<?= REGEX_NAME ?>" required>
                <p class="error"><?= $alert['firstname'] ?? '' ?></p>
            </div>
            <div class="birthdate pb-2">
                <label for="birthdate">Date de Naissance : </label>
                <input type="date" name="birthdate" id="birthdate" value="<?= $birthdate ?? '' ?>" min="<?= date('Y-m-d', strtotime('-130 years')) ?>" max="<?= date('Y-m-d') ?>" required>
                <p class="error"><?= $alert['birthdate'] ?? '' ?></p>
            </div>
            <div class="phone pb-2">
                <label for="phone">Numéro de téléphone : </label>
                <input type="text" name="phone" id="phone" value="<?= $phone ?? '' ?>" pattern="<?= REGEX_PHONENUMBER ?>">
                <p class="error"><?= $alert['phone'] ?? '' ?></p>
            </div>
            <div class="mail pb-2">
                <label for="mail">Mail : </label>
                <input type="mail" name="mail" id="mail" value="<?= $mail ?? '' ?>" pattern="<?= REGEX_EMAIL ?>">
                <p class="error"><?= $alert['mail'] ?? '' ?></p>
            </div>
            <h3 class="text-center pb-2">RDV</h3>
            <div class="date pb-2">
                <label for="dateAppointment">Date :</label>
                <input type="date" name="dateAppointment" id="dateAppointment" value="<?= $dateAppointment ?? '' ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+1 year')) ?>" pattern="<?= REGEX_DATE ?>" required>
                <p class="error"><?= $alert['dateAppointment'] ?? '' ?></p>
            </div>
            <div class="hourMinut pb-2">
                <label for="hour">Heure :</label>
                <div class="d-flex justify-content-around align-items-center">
                    <select name="hour" id="hour-select">
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                    </select>
                    <select name="minut" id="minut-select">
                        <option value="00">00</option>
                        <option value="30">30</option>
                    </select>
                </div>
                <p class="error"><?= $alert['hour'] ?? '' ?></p>
            </div>  
            <div class="btnEnvoyer text-center">
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
</main>