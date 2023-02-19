<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Paziente;

/** @var yii\web\View $this */
/** @var app\models\Test $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        $paziente = new Paziente();
        $query = (new \yii\db\Query)
            ->select(['id_paziente','name', 'surname'])
            ->from('paziente')
            ->orderBy('name');
        $records = $query->all();
        $items = [];
        foreach ($records as $record) {
            $items[$record['id_paziente']] = $record['name'].' '.$record['surname'];
        }
                
        echo $form->field($model, 'paziente_id')->textInput() ->dropdownList($items,['prompt' => 'Seleziona...']);
    ?>
    <br>
    <?= $form->field($model, 'name_test')->textInput(['maxlength' => true]) ?>
    <br>
    <?= $form->field($model, 'descr')->textInput(['maxlength' => true]) ?>
    <br>
    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
    <p>Al seguente campo inserite il link del test che avete definito, si consiglia <a href="https://docs.google.com/forms/u/0/?tgif=d"> Google Form</a></p>

    <div class="form-group mt-4">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
