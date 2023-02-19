<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TerapiaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="terapia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_terapia') ?>

    <?= $form->field($model, 'name_terapia') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'logopedista_id') ?>

    <?= $form->field($model, 'paziente_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
