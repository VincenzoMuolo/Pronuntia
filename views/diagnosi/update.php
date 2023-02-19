<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Diagnosi $model */

$this->title = 'Update Diagnosi: ' . $model->id_diagnosi;

?>
<div class="diagnosi-update">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,'modelR' => $modelR,
    ]) ?>

</div>
