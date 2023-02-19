<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Esercizio $model */

\yii\web\YiiAsset::register($this);
?>

<div class="esercizio-view mt-5">
<?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2>Dettagli Esercizio</h2>
    <br>
    <p>
        <?= Html::a('Aggiorna', ['update', 'id_esercizio' => $model->id_esercizio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id_esercizio' => $model->id_esercizio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Siete sicuri di voler eliminare l\'esercizio? L\'operazione non può essere annullata',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name_esercizio',
            'descr',
            'duration',
            'file_type',
        ],
    ]) ?>
    <?php
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('esercizio')
            ->where(['esercizio.id_esercizio' => $model->id_esercizio]);
        $records = $query->all();
        foreach ($records as $record) {
            $base_file=$record['file'];
            if(str_contains($record['file_type'], ".wav")||
                str_contains($record['file_type'], ".mp3")){
                // Encode the binary audio data as a base64 string
                $base64_audio = base64_encode($base_file);

                // Create a data URL for the audio data
                $data_url = 'data:audio/mpeg;base64,' . $base64_audio;

                // Output the audio data as an HTML <audio> tag
                echo '<audio controls>';
                echo '  <source src="' . $data_url . '" type="audio/mpeg">';
                echo '  Your browser does not support the audio element.';
                echo '</audio>';
            }
            else if(str_contains($record['file_type'], ".pdf")) {
                // Encode the binary PDF data as a base64 string
                $base64_pdf = base64_encode($base_file);

                // Create a data URL for the PDF data
                $data_url = 'data:application/pdf;base64,' . $base64_pdf;

                // Output the PDF data as an HTML <iframe> tag
                echo '<iframe src="' . $data_url . '" width="100%" height="500"></iframe>';
            }
        }
    ?>
</div>
