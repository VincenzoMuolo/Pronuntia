<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Test $model */

$this->title = $model->name_test;
\yii\web\YiiAsset::register($this);
?>
<div class="test-view mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <?php 
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'logopedista', 'user.id_user = logopedista.user_key')
            ->join('INNER JOIN', 'test', 'test.logopedista_id = logopedista.id_logopedista')
            ->where(['id_test' => $model->id_test])
            ->limit(1);
        $records = $query->all();
        foreach ($records as $record) {
                $name=$record['name'].' '.$record['surname'];
        }
        echo Html::beginTag('h4');
        echo 'Prescritto dal logopedista '.$name;
        echo Html::endTag('h4');    
    ?>
    <div style="width: 70%; margin-top:1em;">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'descr',
                [
                    'attribute' => 'link',
                    'format' => 'raw',
                    'value' => \yii\helpers\Html::a('Vai', $model['link'])
                ], 
            ],
        ]) ?>
    </div>
</div>
