<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Paziente $model */

$this->title = 'Aggiorna dati: ' . $model->name;
?>
<div class="paziente-update mt-5">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
