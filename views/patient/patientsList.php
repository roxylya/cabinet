<main class="py-5">
    <h2 class="text-center">Liste des patients</h2>
    <p class="text-center py-1"><?= (isset($_GET["code"]))  ? CODES[$_GET["code"]] : '' ?></p>
    <form action="patientsListCtrl.php" class="text-center py-1" method="get">
        <input type="search" name="research" class="research" value="<?= $research ?? '' ?>">
        <input type="submit" name="submitResearch" class="research" value="Rechercher">
    </form>
    <!-- pagination -->
    <nav aria-label="Page navigation ">
        <ul class="pagination justify-content-center mt-5">
            <li class="page-item <?= ($page == 1) ? "disabled" : "" ?>">
                <a href="/controllers/patientsListCtrl.php?page=<?= $page - 1 ?>" class="page-link" aria-label="Preview">
                    <span aria-hidden="true">&#171; </span>
                </a>
            </li>
            <!-- On va effectuer une boucle autant de fois que l'on a de pages  -->
            <?php for ($i = 1; $i <= $pageNb; $i++) { ?>
                <li class="page-item <?= ($page == $i) ? "active" : "" ?>">
                    <a class="page-link" href="/controllers/patientsListCtrl.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>

            <!-- Affiche de l'icone page suivante sauf sur la dernière page en fonction du pageNb -->
            <?php if ($page < $pageNb) { ?>
                <li class="page-item <?= ($page == $pageNb) ? "disabled" : "" ?>">
                    <a class="page-link" href="/controllers/patientsListCtrl.php?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&#187;</span>
                    </a>
                <?php } ?>
                </li>
        </ul>
    </nav>
    <div class="d-flex flex-column justify-content-center align-items-center mt-5 mb-2">
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

                <tr id="<?= $patient->id ?>">
                    <td><?= $patient->lastname ?></td>
                    <td><?= $patient->firstname ?></td>
                    <td><?= date('d-m-Y', strtotime($patient->birthdate)) ?></td>
                    <td><?= $patient->phone ?></td>
                    <td><?= $patient->mail ?></td>
                    <td class="actions">
                        <a href="/controllers/addPatientCtrl.php?id=<?= $patient->id ?>"><img src="/public/assets/img/loupe.png" class="tools" alt="loupe"></a>
                        <a class="ps-5" data-bs-toggle="modal" data-bs-target="#deletePatient"><img src="/public/assets/img/trash.png" class="tools" alt="poubelle"></a>
                        <!-- Modal -->
                        <div class="modal fade" id="deletePatient" tabindex="-1" aria-labelledby="deletePatientLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deletePatientLabel">Suppression d'un patient</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer ce patient ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btnNo" data-bs-dismiss="modal">Non</button>
                                        <a href="/controllers/deletePatientCtrl.php?id=<?= $patient->id ?>"> <button type="button" class="btn btnDelete">Oui, je supprime ce patient.</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</main>

<!-- Modal -->