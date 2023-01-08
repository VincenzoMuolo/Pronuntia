<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Paziente $model */

$this->title = $model->name;
\yii\web\YiiAsset::register($this);
?>
<div class="paziente-view mt-5">

    <h1>Paziente: <?= Html::encode($this->title) ?></h1>

    <p>
        <h3 class="mt-1">Operazioni</h3>
        <?= Html::a('Aggiorna', ['update', 'id_paziente' => $model->id_paziente], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id_paziente' => $model->id_paziente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare i dati del paziente? Questa operazione non può essere annullata.',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <h3 class="mt-1">Dettagli</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'surname',
            'age',
            [
                'attribute' => 'sex',
                'value' => function ($model) {
                    switch ($model->sex) {
                        case 0:
                            return 'Maschio';
                        case 1:
                            return 'Femmina';
                        default:
                            return 'Errore';
                    }
                },
            ],
        ],
    ]) ?>

</div>
