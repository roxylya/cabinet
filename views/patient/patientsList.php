<main class="py-5">
    <h2 class="text-center">Liste des patients</h2>
    <p class="text-center py-1"><?= $message ?? '' ?></p>
    <form action="patientsListCtrl.php" class="text-center py-1" method="get">
        <input type="search" name="research" class="research" value="<?= $research ?? ''?>">
        <input type="submit" name="submitResearch" class="research" value="Rechercher">
    </form>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5 mb-5">
        <div class="avertissement">Pour accéder aux informations passer en mode paysage.</div>
        <table>
            <tr class="titleCol">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php
                foreach ($patients as $patient) { ?>

            <?= '<tr id="' . $patient->id . '">
                    <td>' . $patient->lastname . '</td>
                    <td>' . $patient->firstname . '</td>
                    <td>' . date('d-m-Y', strtotime($patient->birthdate)) . '</td>
                    <td>' . $patient->phone . '</td>
                    <td>' . $patient->mail . '</td>
                    <td class="actions">
                        <a href="/controllers/addPatientCtrl.php?id=' . $patient->id .
                    '"><img src="/public/assets/img/loupe.png" class="tools" alt="loupe"></a>
                    <a class="ps-5" href="/controllers/deletePatientCtrl.php?id=' . $patient->id .
                    '"><img src="/public/assets/img/trash.png" class="tools" alt="poubelle"></a>
                    </td>
                </tr>';
            }
            ?>
        </table>
    </div>
</main>