<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Paziente $model */

$this->title = 'Registra Paziente';
?>
<div class="paziente-create mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
