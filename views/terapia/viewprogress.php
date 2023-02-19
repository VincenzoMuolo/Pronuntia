<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;
use yii\grid\DataColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Terapia $model */

$this->title = $model->name_terapia;

\yii\web\YiiAsset::register($this);
?>
<div class="terapia-view mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2 class="mb-3">Terapia <?= Html::encode($this->title) ?></h2>
    <div style="width: 65%;">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'descr',
            ],
        ]) ?>
        <h5 class="mt-4">Esercizi</h5>
        <?php echo '<p> Per svolgere gli esercizi accedi all\'<a href="/feedbackesercizio/show_exercises?id_terapia='.$model->id_terapia.'">area paziente</a></p>'?>
        <?php
            $query = (new \yii\db\Query)
                ->select(['*'])
                ->from('terapia')
                ->join('INNER JOIN', 'esercizio', 'esercizio.terapia_id = '.$model->id_terapia)
                ->join('LEFT JOIN', 'feedbackesercizio', 'feedbackesercizio.esercizio_id = esercizio.id_esercizio');
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'emptyText' => 'Nessun risultato trovato',
                'layout' => "{items}\n{pager}",
                'summary' => '',
                'columns' => [
                    [
                        'attribute' => 'name_esercizio',
                        'header' => 'Nome',
                    ],
                    [
                        'class' => DataColumn::class,
                        'format' => 'raw',
                        'header' => 'Stato',
                        'value' => function ($model) {
                            if(isset($model['esercizio_id'])){
                                return "Esercizio svolto";
                            }else{
                                return 'Esercizio non svolto';
                            }
                        },
                    ],
                ],  
            ]);
        ?>
    </div>
</div>