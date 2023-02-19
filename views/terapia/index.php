<?php

use app\models\Terapia;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TerapiaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Terapie';
?>
<div class="terapia-index mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <p>
        <?= Html::a('Crea Terapia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => '',
        'emptyText' => 'Nessun risultato trovato',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name_terapia',
            'descr',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Terapia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_terapia' => $model->id_terapia]);
                 }
            ],
        ],
    ]); ?>


</div>
