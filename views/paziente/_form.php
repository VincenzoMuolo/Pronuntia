<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
/** @var yii\web\View $this */
/** @var app\models\Paziente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="paziente-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model)?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'sex')->dropDownList(['Maschio', 'Femmina'],['prompt'=>'Seleziona...']); ?>
    

    <div class="form-group">
        <?= Html::submitButton('Conferma', ['class' => 'btn btn-success mt-4']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
