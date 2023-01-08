<?php

use app\models\Paziente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PazienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Paziente';
?>
<div class="paziente-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Paziente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_paziente',
            'name',
            'surname',
            'age',
            'sex',
            //'caregiver_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Paziente $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_paziente' => $model->id_paziente]);
                 }
            ],
        ],
    ]); ?> -->


</div>
