<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Referto $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="referto-form mt-3">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('diagnosi')
            ->join('INNER JOIN', 'logopedista', 'diagnosi.logopedista_id = logopedista.id_logopedista')
            ->where(['logopedista.user_key' => Yii::$app->user->identity->id_user]);
        $records = $query->all();
        $items = [];
        foreach ($records as $record) {
            $items[$record['id_diagnosi']] = $record['name_diagnosi'];
        }      
        echo $form->field($model, 'diagnosi_id')->dropdownList($items,['prompt' => 'Seleziona...']);
    ?>

    <?= $form->field($model, 'name_referto')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'descr')->textArea(['maxlength' => true]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
