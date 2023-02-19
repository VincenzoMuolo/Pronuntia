<?php

use app\models\Referto;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RefertoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Referti';
?>
<div class="referto-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Create Referto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_referto',
            'descr',
            'diagnosi_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Referto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_referto' => $model->id_referto]);
                 }
            ],
        ],
    ]); ?>


</div>
