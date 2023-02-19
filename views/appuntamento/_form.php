<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Appuntamento $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="Appuntamento-form form-box">

    <?php $form = ActiveForm::begin(); ?>
    <p>Data e ora dovranno essere inserite secondo il seguente formato: <i style="font-weight:bold; color: #444"> aaa-mm-dd hh:mm</i></p>
    <p>Esempio <i style="font-weight:bold; color: #444">2023-12-01 09:00</i></p>
    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'state')->dropDownList([ 'libero' => 'Libero', 'occupato' => 'Occupato', ], ['prompt' => '']) ?>

    <div class="form-group mt-4">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
