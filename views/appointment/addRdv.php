<main>
    <h2 class="text-center pt-5">Nouveau RDV</h2>
    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
        <p class="messageOk p-2"><?= $messageOk ?? '' ?></p>
        <form method="post" class="form p-4">
            <div class="date p-3">
                <label for="dateAppointment">Date :</label>
                <input type="date" name="dateAppointment" id="dateAppointment" value="<?= $dateAppointment ?? '' ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+1 year')) ?>" pattern="<?= REGEX_DATE ?>" required>
                <p class="error"><?= $alert['dateAppointment'] ?? '' ?></p>
            </div>
            <div class="hourMinut p-3">
                <label for="hour">Heure :</label>
                <div class="d-flex justify-content-around align-items-center">
                    <select name="hour" id="hour-select">
                        <option value="9">9</option>
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