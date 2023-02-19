<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Esercizio $model */

$this->title = 'Crea Esercizio';
?>
<div class="esercizio-create mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <p style="width:70%">In quest'area è possibile definire esercizi da somministrare ai pazienti, possono essere descritti testualemte
     oppure contenere allegati tipo pdf o audio per personalizzare ulteriormente gli esercizi.
        <br>Inoltre si dovrà definire la terapia in cui verrà utilizzato l'esercizio.
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
