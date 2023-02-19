<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Diagnosi $model */

$this->title = 'Crea Diagnosi';
?>
<div class="diagnosi-create mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <p style="width:70%">In questa sezione è possibile documentare ed aggiornare la diagnosi del paziente
        <br>Il sistema è strutturato in modo da creare una sola diagnosi per paziente ma con un numero indefinito di referti,
        quindi idealmente dopo aver creato la diagnosi essa potrà essere aggiornata scrivendo nuovi referti.
    </p>
    <?= $this->render('_form', [
        'model' => $model,'modelR' => $modelR,
    ]) ?>

</div>
