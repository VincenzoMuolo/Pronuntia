<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Appuntamento $model */

$this->title = 'Riepilogo';
\yii\web\YiiAsset::register($this);
?>
<div class="appuntamento-view mt-5">
    <a class="back-button" href="/appuntamento/index">Home</a>
    <h2 class="mb-3"><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Aggiorna', ['update', 'id_date' => $model->id_date], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id_date' => $model->id_date], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare l\'appuntamento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'state',
        ],
    ]) ?>

</div>
