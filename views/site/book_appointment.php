<?php

    /** @var yii\web\View $this */

    use yii\web\View;
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;
    use app\assets\AppAsset;
    use app\models\Paziente;
    use yii\helpers\BaseHtml;
    $this->title = 'Prenota visita';
?>
<div class="site-book-appointment mt-4">
    <a class="back-button" href="/site/index">Home</a>
    <h2> <?= Html::encode($this->title) ?> </h2>

    <p style="width:66ch;">Modulo prenotazione visita, di seguito sarà richiesto di selezinare il paziente che necessita della visita e il logopedista, scelto il logopedista sarà possibile visualizzare le date disponibili.</p>
    
    <br>
        <!-- Elenco Logopedisti -->
        <?php $form = ActiveForm::begin([
        'id' => 'form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control','style' => 'width:95%; margin-left:1em;'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <?php
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'logopedista', 'user.id_user = logopedista.user_key')
            ->orderBy('name');
        $records = $query->all();
        $items = [];
        foreach ($records as $record) {
            $items[$record['id_logopedista']] = $record['name'].' '.$record['surname'];
        }
        echo $form->field($newPrenotazioneSearch, 'logopedista_id')->dropdownList($items, ['prompt' => 'Seleziona...']);
    ?>
    <div class="form-group">
        <div class="">
            <?= Html::submitButton('Controlla appuntamenti', ['class'=> 'btn btn-primary', 'name'=> 'button'])?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $bookForm = ActiveForm::begin([
        'id' => 'book-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control','style' => 'width:95%; margin-left:1em;'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <!-- Salva Logopedista -->
    <div style="visibility:hidden; position:absolute;">
    <?php
        if (Yii::$app->request->isPost) {
            $query = (new \yii\db\Query)
                ->select(['*'])
                ->from('prenotazionesearch')
                ->orderBy(['id_prenotazione' => SORT_DESC])
                ->limit(1);
            $records = $query->all();
            foreach ($records as $record) {
                $id=$record['logopedista_id'];
            }
            echo $bookForm->field($newPrenotazione, 'logopedista_id')->textInput(['value' => $id]);
        }
    ?>
    </div>
    <!-- Elenco date -->
    <br>
    <?php
        if (Yii::$app->request->isPost) {
            $query = (new \yii\db\Query)
                ->select(['*'])
                ->from('prenotazionesearch')
                ->orderBy(['id_prenotazione' => SORT_DESC])
                ->limit(1);
            $records = $query->all();
            foreach ($records as $record) {
                $id=$record['logopedista_id'];
            }
            $query = (new \yii\db\Query)
                ->select(['*'])
                ->from('appuntamento')
                ->where(['state'=> 'libero'])
                ->join('INNER JOIN', 'logopedista', 'appuntamento.logopedista_id ='.$id);
            $records = $query->all();
            $items = [];
            foreach ($records as $record) {
                $items[$record['id_date']] = $record['date'];
            }
            echo $bookForm->field($newPrenotazione, 'date_id')->dropdownList($items,['prompt' => 'Seleziona una data...']);
        }
    ?>
    <?= $bookForm->errorSummary($newPrenotazione)?>
        <br>   
    <!-- Elenco Pazienti del caregiver -->
    <?php
        $paziente = new Paziente();
        $caregiver_id = $paziente->sessionCaregiver();
        $query = (new \yii\db\Query)
            ->select(['id_paziente','name', 'surname'])
            ->from('paziente')
            ->where(['caregiver_id' => $caregiver_id])
            ->orderBy('name');
        $records = $query->all();
        $items = [];
        foreach ($records as $record) {
            $items[$record['id_paziente']] = $record['name'].' '.$record['surname'];
        }
                
        echo $bookForm->field($newPrenotazione, 'paziente_id')->dropdownList($items,['prompt' => 'Seleziona...']);
    ?>
</div>

<div class="form-group">
    <div class="">
        <?= Html::submitButton('Prenota', ['class'=> 'btn btn-primary', 'name'=> 'book-button'])?>
    </div>
</div>
<br>
<?php ActiveForm::end(); ?>
