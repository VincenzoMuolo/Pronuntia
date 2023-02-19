<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Referto $model */
$this->title = 'Crea Referto';
?>
<div class="referto-create mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
