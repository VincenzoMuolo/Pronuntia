<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AppuntamentoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appuntamento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_date') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'state') ?>

    <?= $form->field($model, 'logopedista_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
