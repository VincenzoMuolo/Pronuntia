<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Esercizio $model */

$this->title = 'Aggiorna Esercizio: ' . $model->name_esercizio;
?>
<div class="esercizio-update mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
