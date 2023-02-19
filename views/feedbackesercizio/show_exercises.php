<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Feedbackesercizio $id_terapia */

$this->title = 'Elenco Esercizi';
\yii\web\YiiAsset::register($this);
?>

<div class="show_exercises mt-5 on-top">
<?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <div class="main-area">

    <?php
        $query = (new \yii\db\Query)
            ->select(['name_esercizio','esercizio.descr','id_esercizio','id_feedback'])
            ->from('terapia')
            ->join('INNER JOIN', 'esercizio', 'esercizio.terapia_id = '.$id_terapia)
            ->join('LEFT JOIN', 'feedbackesercizio', 'feedbackesercizio.esercizio_id = esercizio.id_esercizio');
        $records = $query->all();
        foreach ($records as $record) {
            if($record['id_feedback']==null){
                echo Html::beginTag('div',['class' => 'content-area']);
                echo Html::beginTag('h4', ['class' => 'title-area']);
                echo $record['name_esercizio'];
                echo Html::endTag('h4');
                echo $record['descr'];
                echo Html::beginTag('br');
                echo Html::beginTag('br');
                echo Html::a('Svolgi', '/feedbackesercizio/create?id_esercizio='.$record['id_esercizio'], ['class' => 'area-button']);
                echo Html::endTag('div');
            }
        }
    ?>

    </div>

</div>