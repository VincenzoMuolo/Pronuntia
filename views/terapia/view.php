<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;
use yii\grid\DataColumn;
use yii\grid\GridView;
use yii\bootstrap5\Modal;
/** @var yii\web\View $this */
/** @var app\models\Terapia $model */

$this->title = $model->name_terapia;

\yii\web\YiiAsset::register($this);
?>
<div class="terapia-view mt-5">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <h2 class="mb-3">Terapia <?= Html::encode($this->title) ?></h2>
    <div style="width: 70%;">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'descr',
            ],
        ]) ?>
        <h5 class="mt-4">Esercizi</h5>
        <?php
            $query = (new \yii\db\Query)
                ->select(['*'])
                ->from('terapia')
                ->join('INNER JOIN', 'esercizio', 'esercizio.terapia_id = '.$model->id_terapia);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'emptyText' => 'Nessun risultato trovato',
                'layout' => "{items}\n{pager}",
                'summary' => '',
                'columns' => [
                    [
                        'attribute' => 'name_esercizio',
                        'header' => 'Nome',
                    ],
                    [
                        'class' => DataColumn::class,
                        'format' => 'raw',
                        'header' => 'Dettagli Esercizio',
                        'value' => function ($model) {
                            return Html::a('Vai', ['/esercizio/view?id_esercizio='.$model['id_esercizio']]);
                        },
                    ],
                ],  
            ]);
        ?>
    </div>
    <br>
    <h4>Esercizi svolti</h4>
    <?php
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('esercizio')
            ->join('INNER JOIN', 'feedbackesercizio', 'feedbackesercizio.esercizio_id = esercizio.id_esercizio')
            ->where(['esercizio.terapia_id' => $model->id_terapia]);
            $records = $query->all();
            $evaluation = 0;
            foreach ($records as $record) {
                switch ($record['evaluation']) {
                    case 1:
                        $evaluation = 'Molto efficace';
                        break;
                    case 2:
                        $evaluation = 'Efficace';
                        break;
                    case 3:
                        $evaluation = 'Poco efficace';
                        break;
                    case 4:
                        $evaluation = 'Non efficace';
                        break;
                    default:
                        $evaluation = 'Errore';
                        break;
                }
                $base_file=$record['file'];
                if(str_contains($record['file_type'], ".wav")||
                    str_contains($record['file_type'], ".mp3")){
                    // Encode the binary audio data as a base64 string
                    $base64_audio = base64_encode($base_file);

                    // Create a data URL for the audio data
                    $data_url = 'data:audio/mpeg;base64,' . $base64_audio;

                    // Output the audio data as an HTML <audio> tag
                    $actual_file = '<audio controls>
                                    <source src="' . $data_url . '" type="audio/mpeg">
                                    Il vostro browser non supporta file audio.
                                    </audio>';
                }
                else if(str_contains($record['file_type'], ".pdf")) {
                    // Encode the binary PDF data as a base64 string
                    $base64_pdf = base64_encode($base_file);

                    // Create a data URL for the PDF data
                    $data_url = 'data:application/pdf;base64,' . $base64_pdf;

                    // Output the PDF data as an HTML <iframe> tag
                    $actual_file = '<iframe src="' . $data_url . '" width="100%" height="500px"></iframe>';
                }
                echo '<div class="content-grid">
                    <section class="section-col">
                    <h6>Nome esercizio</h6>
                    <div class="section-line"></div>
                    <p>'.$record['name_esercizio'].'</p>
                    </section>
                    <section class="section-col">
                    <h6>Note svolgimento</h6>
                    <div class="section-line"></div>
                    <p>'.$record['descr'].'</p>
                    </section>
                    <section class="section-col">
                    <h6>Esito</h6>
                    <div class="section-line"></div>
                    <p>'.$record['result'].'</p>
                    </section>
                    <section class="section-col">
                    <h6>Valutazione Gradimento</h6>
                    <div class="section-line"></div>
                    <p>'.$evaluation.'</p>
                    </section>
                    <section class="section-col" style=" border: none;!important">
                    <h6>Tempo Impiegato</h6>
                    <div class="section-line"></div>
                    <p>'.$record['duration'].' minuti</p>
                    </section>
                    </div><br>
                    <div class="">'.$actual_file.'</div><br><br>';
            }
    ?>
</div>

<!-- 
    $base_file=$model['file'];
                            if(str_contains($model['file_type'], ".wav")||
                                str_contains($model['file_type'], ".mp3")){
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
                            else if(str_contains($model['file_type'], ".pdf")) {
                                // Encode the binary PDF data as a base64 string
                                $base64_pdf = base64_encode($base_file);

                                // Create a data URL for the PDF data
                                $data_url = 'data:application/pdf;base64,' . $base64_pdf;

                                // Output the PDF data as an HTML <iframe> tag
                                echo '<iframe src="' . $data_url . '" width="100%" height="100"></iframe>';
                            }
 -->