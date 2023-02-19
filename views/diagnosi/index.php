<?php
namespace app\models;
use app\models\Diagnosi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\DataColumn;

/** @var yii\web\View $this */
/** @var app\models\DiagnosiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Diagnosi';
?>
<div class="diagnosi-index mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <p style="width:70%">In questa sezione potete creare una diagnosi per documentare il percorso del paziente,
        inoltre è possibile creare nuovi referti per aggiornarla.</p>
    <br>
    <p>
        <?= Html::a('Nuova Diagnosi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php

    $logopedista = new Diagnosi();
    $id = $logopedista->sessionLogopedista();
        $query = (new \yii\db\Query)
            ->select(['paziente.name','paziente.surname','id_diagnosi','name_diagnosi'])
            ->distinct()
            ->from('diagnosi')
            ->join('INNER JOIN', 'referto', 'diagnosi.id_diagnosi = referto.diagnosi_id')
            ->join('INNER JOIN', 'paziente', 'diagnosi.paziente_id = paziente.id_paziente')
            ->where(['logopedista_id' =>$id]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'emptyText' => 'Nessun risultato trovato',
            'columns' => [
                [
                    'attribute' => 'name_diagnosi',
                    'header' => 'Nome Diagnosi',                          
                ],
                [
                    'class' => DataColumn::class,
                    'format' => 'raw',
                    'header' => 'Diagnosi Completa',
                    'value' => function ($model) {
                        return Html::a('Visualizza', ['/diagnosi/view?id_diagnosi='.$model['id_diagnosi']]);
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="delete-button" style="position:static; float:right">Cancella Diagnosi</span>', 
                                ['delete', 'id_diagnosi' => $model['id_diagnosi']], 
                                [
                                    'data-confirm' => 'Siete sicuri di voler elimiare la diagnosi selezionata?',
                                    'data-method' => 'post',
                                ]
                            );
                        },
                    ],
                ],
            ],
        ]);  
    ?>
</div>
