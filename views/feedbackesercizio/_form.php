<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Feedbackesercizio $model */
/** @var yii\widgets\ActiveForm $form */
?> 

<div class="feedbackesercizio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descr')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'result')->dropDownList([ 'Svolto' => 'Svolto', 'Non svolto' => 'Non svolto', ], ['prompt' => 'Seleziona...']) ?>

    <?= $form->field($model, 'file')->fileInput() ?>
    
    <br>
    <p>Quanto tempo ha impiegato il paziente a svolgere l'esercizio? (scrivete il valore in minuti. Esempio <i style="font-weight:bold; color: #444">15</i>)</p>
    <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>

    <div style="display:none"><?= $form->field($model, 'esercizio_id')->textInput(['value' =>$id_esercizio]) ?></div>

    <?= $form->field($model, 'evaluation')->dropDownList([ '1' => 'Molto efficace', '2' => 'Efficace', '3' => 'Poco efficace', '4' => 'Non efficace', ], ['prompt' => 'Valutazione...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Conferma', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end();?>
</div>
