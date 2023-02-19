<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Test $model */

$this->title = $model->name_test;
\yii\web\YiiAsset::register($this);
?>
<div class="test-view mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <p>
        <?= Html::a('Modifica', ['update', 'id_test' => $model->id_test], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina', ['delete', 'id_test' => $model->id_test], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siete sicuri di voler eliminare il test? L\'operazione non può essere annullata',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name_test',
            'descr',
            'link',
        ],
    ]) ?>

</div>
