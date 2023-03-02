
<div class="w-50 card text-center mx-auto my-5">
    <div class="card-header">
        Détail Rdv
    </div>
    <div class="card-body">
        <h5 class="card-title"> <?= $appointment->lastname . ' ' . $appointment->firstname ?></h5>
        <p class="card-text text-center"><?= date('d-m-Y H:i',strtotime($appointment->dateHour)) ?></p>
            <a href="#" class="btn btn-primary">Modifier</a>
    </div>
</div>