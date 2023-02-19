<?php

use app\models\Paziente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\PazienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dati paziente rimossi';
?>
<div class="paziente-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <p>
        <?= Html::a('Torna alla homepage', ['href' => $this->goHome()]) ?>
    </p>
</div>
