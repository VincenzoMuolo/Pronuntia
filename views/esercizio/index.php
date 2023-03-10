<?php

use app\models\Esercizio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\DataColumn;

/** @var yii\web\View $this */
/** @var app\models\EsercizioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Esercizi';
?>
<div class="esercizio-index mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <p style="width:70%">In questa sezione è possibile creare gli esercizi da somministrare ai pazienti.</p>
    <p>
        <?= Html::a('Crea Esercizio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => 'Nessun risultato trovato',
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name_esercizio',
            'descr',
            [
                'class' => DataColumn::class,
                'format' => 'raw',
                'header' => 'Allegato',
                'value' => function ($model) {
                    if($model['file_type']!=null){
                        return $model['file_type'];
                    }else{
                        return 'No allegato';
                    }
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Esercizio $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_esercizio' => $model->id_esercizio]);
                 }
            ],
        ],
    ]); ?>


</div>
