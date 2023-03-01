<main>
    <h2 class="text-center p-5">Agenda</h2>
    <div class="d-flex flex-column justify-content-center align-items-center mb-5">
        <div class="avertissement">Pour accéder aux informations passer en mode paysage.</div>
        <table>
            <tr class="titleCol">
                <th>Date/Heure </th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($appointments as $appointment) { ?>

            <?= '<tr id="' . $appointment->idAppointment . '">
                    <td>' . date('d-m-Y H:i',strtotime($appointment->dateHour)) . '</td>
                    <td>' . $appointment->lastname . '</td>
                    <td>' . $appointment->firstname . '</td>
                    <td>' . $appointment->phone . '</td>
                    <td class="actions">
                        <a href="/controllers/addRdvCtrl.php?idAppointment=' . $appointment->idAppointment .
                    '"><img src="/public/assets/img/loupe.png" class="tools" alt="loupe"></a>
                    </td>
                </tr>';
            }
            ?>
        </table>
    </div>
</main>