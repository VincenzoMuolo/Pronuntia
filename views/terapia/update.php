<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Terapia $model */

$this->title = 'Aggiorna Terapia: ' . $model->id_terapia;
?>
<div class="terapia-update">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
