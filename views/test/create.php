<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Test $model */

$this->title = 'Crea Test';
?>
<div class="test-create mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <p style="width:60%;">La creazione di test personalizzati per ogni paziente vi dà la possibilità di ricevere informazioni utili a stilare una prima diagnosi del paziente.
    Eventualmente potete far svolgere ulteriori test durante la terapia.
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
