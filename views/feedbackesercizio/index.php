<?php

use app\models\Feedbackesercizio;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\DataColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\FeedbackesercizioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Area Paziente';
?>
<div class="feedbackesercizio-index mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <?php
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('paziente')
            ->join('INNER JOIN', 'terapia', 'terapia.paziente_id = paziente.id_paziente');
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'emptyText' => 'Nessun paziente in terapia',
            'columns' => [
                [
                    'attribute' => 'name',
                    'header' => 'Nome',
                ],
                [
                    'attribute' => 'surname',
                    'header' => 'Cognome',
                ],
                [
                    'attribute' => 'name_terapia',
                    'header' => 'Terapia',
                ],
                [
                    'class' => DataColumn::class,
                    'format' => 'raw',
                    'header' => 'Esercizi Terapia',
                    'value' => function ($model) {
                        return Html::a('Vai', ['/feedbackesercizio/show_exercises?id_terapia='.$model['id_terapia']]);
                    },
                ],
            ],
        ]);
    ?>

</div>
