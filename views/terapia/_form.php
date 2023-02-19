<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Terapia $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="terapia-form mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_terapia')->textInput(['maxlength' => true]) ?>
    <br>
    <?= $form->field($model, 'descr')->textArea(['maxlength' => true]) ?>
    <br>
    <?php
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('paziente');
        $records = $query->all();
        $items = [];
        foreach ($records as $record) {
            $items[$record['id_paziente']] = $record['name'].' '.$record['surname'];
        }
        echo $form->field($model, 'paziente_id')->dropdownList($items, ['prompt' => 'Seleziona...']);
    ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
