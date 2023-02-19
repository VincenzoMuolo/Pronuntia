<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EsercizioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="esercizio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_esercizio') ?>

    <?= $form->field($model, 'name_esercizio') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'file') ?>

    <?= $form->field($model, 'file_type') ?>

    <?php // echo $form->field($model, 'logopedista_id') ?>

    <?php // echo $form->field($model, 'terapia_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
