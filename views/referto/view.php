<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Referto $model */

$this->title = $model->name_referto;

\yii\web\YiiAsset::register($this);
?>
<div class="referto-view mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <p>
        <?= Html::a('Aggiorna', ['update', 'id_referto' => $model->id_referto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id_referto' => $model->id_referto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siete sicuri di voler eliminare il referto? L\'operazione non può essere annullata',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_referto',
            'descr',
            'diagnosi_id',
        ],
    ]) ?>

</div>
