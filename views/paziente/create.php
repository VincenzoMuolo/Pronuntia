<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Paziente $model */

$this->title = 'Registra Paziente';
?>
<div class="paziente-create mt-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
