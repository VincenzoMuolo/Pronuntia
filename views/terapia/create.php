<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Terapia $model */

$this->title = 'Crea Terapia';
?>
<div class="terapia-create mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <h4>Informazioni</h4>
    <p style="width:70%;"><b>Descrizione </b>fornisca una descrizione della terapia, ad esempio la cadenza con cui dovrebbero essere
        svolti gli esercizi o in generale altre informazioni utili al caregiver per supportare al meglio il suo assistito.
    <br>Gli esercizi si potranno aggiungere dopo aver creato la terapia ed accedendo alla sezione apposita.</p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
