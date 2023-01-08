<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Paziente $model */

$this->title = 'Aggiorna dati: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pazientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_paziente' => $model->id_paziente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paziente-update mt-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
