<?php

use app\models\Test;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Test per i pazienti';
?>
<div class="test-index mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <p>In questa sezione è possibile creare dei questionari da somministrare ai pazienti.</p>
    <br>
    <div style="display:flex; align-items:center; gap:1em; justify-content:flex-end;">
        <h5 style="margin:0">Controlla forms compilati</h5>
        <a class="basic-button" style="position:static" href="https://docs.google.com/forms/u/0/?tgif=d">Google Forms</a>
    </div>
    <br>
    <p>
        <?= Html::a('Crea Nuovo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>' ',
        'emptyText' => 'Nessun risultato trovato',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name_test',
            'descr',
            [
                'attribute' => 'link',
                'format' => 'raw',
                'header' => 'Link test',
                'value' => function ($dataProvider) {
                    return Html::a($dataProvider['link'], $dataProvider['link']);
                },
            ], 
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Test $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_test' => $model->id_test]);
                 }
            ],
        ],
    ]); ?>

</div>
