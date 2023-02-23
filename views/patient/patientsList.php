<main>
    <h2 class="text-center p-5">Liste des patients</h2>
    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
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
            <?php foreach ($patients as $patient) { ?>

            <?= '<tr id="' . $patient->id . '">
                    <td>' . $patient->lastname . '</td>
                    <td>' . $patient->firstname . '</td>
                    <td>' . date('d-m-Y', strtotime($patient->birthdate)) . '</td>
                    <td>' . $patient->phone . '</td>
                    <td>' . $patient->mail . '</td>
                    <td class="actions">
                        <a href="/controllers/addPatientCtrl.php?id=' . $patient->id .
                    // '&lastname=' . $patient->lastname .
                    // '&firstname=' . $patient->firstname .
                    // '&birthdate=' . date('d-m-Y', strtotime($patient->birthdate)) .
                    // '&phone=' . $patient->phone .
                    // '&mail=' . $patient->mail . 
                    '"><img src="/public/assets/img/loupe.png" class="tools" alt="loupe"></a>
                    </td>
                </tr>';
            }
            ?>
        </table>
    </div>
</main>