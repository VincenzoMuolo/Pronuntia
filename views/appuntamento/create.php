<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Appuntamento $model */

$this->title = 'Aggiungi Data Appuntamento';
?>
<div class="appuntamento-create mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2 class="mb-5"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
