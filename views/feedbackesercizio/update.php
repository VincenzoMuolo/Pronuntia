<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Feedbackesercizio $model */

$this->title = 'Update Feedbackesercizio: ' . $model->id_feedback;
$this->params['breadcrumbs'][] = ['label' => 'Feedbackesercizios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_feedback, 'url' => ['view', 'id_feedback' => $model->id_feedback]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feedbackesercizio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
