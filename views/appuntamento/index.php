<?php

use app\models\Appuntamento;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AppuntamentoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Agenda Appuntamenti';

?>
<div class="appuntamento-index mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <p>Si prega di definire date per gli appuntamenti con i pazienti.</p>
    <p class="mt-4 mb-3">
        <?= Html::a('Aggiungi data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'emptyText' => 'Nessun risultato trovato',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'date',
            'state',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Appuntamento $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_date' => $model->id_date]);
                 }
            ],
        ],
    ]); ?>


</div>
