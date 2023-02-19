<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Test $model */

$this->title = 'Aggiorna Test';
?>
<div class="test-update mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
