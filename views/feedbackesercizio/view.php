<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Feedbackesercizio $model */

$this->title = "Riepilogo";
\yii\web\YiiAsset::register($this);
?>
<div class="feedbackesercizio-view">
    <br>
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <p>
        <?= Html::a('Aggiorna', ['update', 'id_feedback' => $model->id_feedback], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id_feedback' => $model->id_feedback], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siete sicuri di voler cancellare il feedback sull\'esercizio?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'descr',
            'result',
            'duration',
            'evaluation',
            'file_type',
        ],
    ]) ?>

</div>
