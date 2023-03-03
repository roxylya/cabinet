<main>
   
    <h2 class="text-center pt-5">Agenda</h2> 
    <p class="text-center p-3"><?= $message ?? '' ?></p>
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
                <tr id="apt<?=  $appointment->idAppointment ?>">
                    <td><?= date('d-m-Y H:i',strtotime($appointment->dateHour)) ?></td>
                    <td><?= $appointment->lastname ?></td>
                    <td><?= $appointment->firstname ?></td>
                    <td><?= $appointment->phone ?></td>
                    <td class="actions">
                        <a href="<?= (date('d-m-Y H:i',strtotime($appointment->dateHour))<= date('d-m-Y H:i')) ? '#' : '/controllers/addRdvCtrl.php?idAppointment='. $appointment->idAppointment ?>" >
                        <img src="/public/assets/img/loupe.png" class="tools" alt="loupe"></a>
                    <a class="ps-5" href="/controllers/deleteRdvCtrl.php?idAppointment=<?=$appointment->idAppointment ?>">
                    <img src="/public/assets/img/trash.png" class="tools" alt="poubelle"></a>
                    </td>
                </tr>
            <?php ;}
            ?>
        </table>
    </div>
</main>

