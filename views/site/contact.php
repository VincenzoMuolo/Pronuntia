<?php

/** @var yii\web\View $this */
use yii\grid\GridView;
use yii\web\View;
use yii\bootstrap5\Html;
$this->title = 'Contatta Logopedista';
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html>
    <head>
    </head>
<?php   $this->beginBody()?>
    <body>
        <div class="contact mt-5">
            <h2>
                <?= Html::encode($this->title) ?>
            </h2>
            <div class="pt-4">
                <?php
                    $query = (new \yii\db\Query)
                        ->select(['*'])
                        ->from('user')
                        ->join('INNER JOIN', 'logopedista', 'user.id_user = logopedista.user_key')
                        ->orderBy('name');
                        $dataProvider = new \yii\data\ActiveDataProvider([
                            'query' => $query,
                        ]);
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
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
                            /* [
                                'attribute' => 'address',
                                'header' => 'Indirizzo',
                            ], */
                            [
                                'attribute' => 'specs',
                                'header' => 'Specializzazione',
                            ],
                            [
                                'attribute' => 'address',
                                'format' => 'raw',
                                'header' => 'Indirizzo',
                                'value' => function ($dataProvider) {
                                    return Html::a($dataProvider['address'], 'https://www.google.com/maps?q=' . urlencode($dataProvider['address']));
                                },
                            ],
                            
                            [
                                'attribute' => 'email',
                                'format' => 'raw',
                                'value' => function ($dataProvider) {
                                    return Html::mailto($dataProvider['email'], $dataProvider['email']);
                                },
                            ],
                            [
                                'attribute' => 'mobile_phone',
                                'format' => 'raw',
                                'header' => 'Numero telefonico',
                                'value' => function ($dataProvider) {
                                    return Html::a($dataProvider['mobile_phone'], 'tel:'.$dataProvider['mobile_phone']);
                                },
                            ],
                        ],
                    ]);
                ?>
            </div>
    </body>
    <?php $this->endBody()?>
</html>
<?php $this->endPage()?>