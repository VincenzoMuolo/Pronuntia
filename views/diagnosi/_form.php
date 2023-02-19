<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Diagnosi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="diagnosi-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Nome diagnosi -->
    <div style="display:none">
        <?= $form->field($model, 'name_diagnosi')->textInput(['value' => 'Diagnosi']) ?>
    </div>

    <!-- Elenco Pazienti -->
    <?php
        $query = (new \yii\db\Query)
            ->select(['id_paziente','name', 'surname'])
            ->from('paziente')
            ->orderBy('name');
        $records = $query->all();
        $items = [];
        foreach ($records as $record) {
            $items[$record['id_paziente']] = $record['name'].' '.$record['surname'];
        }
                
        echo $form->field($model, 'paziente_id')->dropdownList($items,['prompt' => 'Seleziona...']);
    ?>
    <?= $form->errorSummary($modelR)?>

    <!-- Referto -->
    <?= $form->field($modelR, 'name_referto')->textInput() ?>
    <?= $form->field($modelR, 'descr')->textArea() ?>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
