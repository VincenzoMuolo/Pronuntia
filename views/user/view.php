<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <br><br>
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>    
    <h2>Visualizza profilo</h2>
    
    <br><br>

    <?php
        $queryCaregiver = (new \yii\db\Query)
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'caregiver', 'user.id_user = caregiver.user_key')
            ->where(['id_user'=>Yii::$app->user->identity->id_user]);
        $dataCaregiver = new \yii\data\ActiveDataProvider([
            'query' => $queryCaregiver,
        ]);
        $queryLogopedista = (new \yii\db\Query)
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'logopedista', 'user.id_user = logopedista.user_key')
            ->where(['id_user'=>Yii::$app->user->identity->id_user]);
        $dataLogopedista = new \yii\data\ActiveDataProvider([
            'query' => $queryLogopedista,
        ]);
        
        $resultC = $queryCaregiver->count();
        $resultL = $queryLogopedista->count();
        if($resultC>0){
            echo GridView::widget([
                'dataProvider' => $dataCaregiver,
                'emptyText' => 'Nessun risultato trovato',
                'layout' => "{items}\n{pager}",
                'summary' => '',
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
                        'attribute' => 'email',
                        'header' => 'E-mail',
                    ],
                    [
                        'attribute' => 'mobile_phone',
                        'header' => 'Telefono',
                    ],
                ]
            ]);
        }else if($resultL>0){
            echo GridView::widget([
                'dataProvider' => $dataLogopedista,
                'emptyText' => 'Nessun risultato trovato',
                'layout' => "{items}\n{pager}",
                'summary' => '',
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
                        'attribute' => 'email',
                        'header' => 'E-mail',
                    ],
                    [
                        'attribute' => 'mobile_phone',
                        'header' => 'Telefono',
                    ],
                    [
                        'attribute' => 'address',
                        'header' => 'Indirizzo',
                    ],
                    [
                        'attribute' => 'specs',
                        'header' => 'Specializzazione',
                    ],
                ]
            ]);
        }
    ?>

</div>
