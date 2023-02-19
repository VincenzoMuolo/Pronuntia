<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Referto $model */

$this->title = 'Aggiorna Referto: ' . $model->id_referto;
?>
<div class="referto-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
