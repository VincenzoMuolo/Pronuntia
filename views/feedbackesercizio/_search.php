<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\FeedbackesercizioSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="feedbackesercizio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_feedback') ?>

    <?= $form->field($model, 'descr') ?>

    <?= $form->field($model, 'result') ?>

    <?= $form->field($model, 'evaluation') ?>

    <?= $form->field($model, 'file') ?>

    <?php // echo $form->field($model, 'file_type') ?>

    <?php // echo $form->field($model, 'esercizio_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
