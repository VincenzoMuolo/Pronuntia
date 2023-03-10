<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Esercizio;

/** @var yii\web\View $this */
/** @var app\models\Esercizio $model */
/** @var yii\widgets\ActiveForm $form */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<div class="esercizio-form mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $logopedista_search = new Esercizio();
    $id_logo = $logopedista_search->sessionLogopedista();
    $query = (new \yii\db\Query)
        ->select(['*'])
        ->from('terapia')
        ->join('INNER JOIN', 'logopedista', 'terapia.logopedista_id ='.$id_logo);
        $records = $query->all();
        $items = [];
        foreach ($records as $record) {
            $items[$record['id_terapia']] = $record['name_terapia'];
        }
        echo $form->field($model, 'terapia_id')->dropdownList($items,['prompt' => 'Seleziona...']);
    ?>

    <?= $form->field($model, 'name_esercizio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->textArea(['maxlength' => true]) ?>
    
    <p>Definire una durata ideale per lo svolgimento dell'esercizio in minuti ( Esempio <i style="font-weight:bold; color: #444">10</i> )</p>
    <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>

    <br>
    <div class="custom-div resize-center" style="box-shadow:none; padding:0; width:100%">
        <h4 style="margin:0 1.5em; padding-block:1.25em; position:relative"> Registra Audio <span id="icon-more" class="material-symbols-outlined custom-arrow" onclick="hide()">expand_more</span></h4>
        <div id="audio-detail" class="default-show hide">
            <p class="padd">
                In questa sezione è possibile registrare l'audio per proporre al paziente un esercizio basato
                sulla vostra voce.
            </p>
            
            <div class="button-box">
                <!-- The button to start recording -->
                <button type="button" class="record-button" id="start-recording">Avvia Registrazione</button>
                
                <!-- The button to stop recording -->
                <button type="button" class="record-button" id="stop-recording" disabled>Ferma Registrazione</button>
            </div>
            <div id="feedback-rec-on" class="animation-box">
                <h5 class="centered" >Registrazione in corso</h5>
                <div class="lds-ripple" ><div></div><div></div></div>
            </div>
            <!-- The audio tag that will be used to play the recorded audio -->
            <div class="rec-box">
                <audio controls id="recorded-audio"></audio>
                <button class="dl-color" id="downloadContainer">
                    <a id="downloadButton" href="" download="" class="button-link">Scarica Registrazione</a>
                </button>
            </div>
        
        </div>
    </div>
    <br>
    <i><b>OPZIONALE</b></i>
    <p>Qui di seguito potete caricare la registrazione precedentemente realizzata oppure caricare un vostro file audio, video o documento PDF.</p>
    <div class="custom-area">
        <?= $form->field($model, 'file')->fileInput()?>
    </div>
    <div class="form-group mt-3">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function hide(){
        document.getElementById("icon-more").classList.toggle("active-arrow-switch");
        document.getElementById("audio-detail").classList.toggle("hide");
    }

    // Get references to the start and stop recording buttons
    const startRecordingButton = document.getElementById("start-recording");
    const stopRecordingButton = document.getElementById("stop-recording");
    const rec_on = document.getElementById("feedback-rec-on");
    const button_container = document.getElementById("downloadContainer");
    // set download button event
    const button_dl = document.getElementById("downloadButton");
    button_dl.addEventListener("click", downloadName);

    // Get a reference to the recorded audio element
    const recordedAudio = document.getElementById("recorded-audio");

    // Create a MediaRecorder object
    let mediaRecorder;

    // Handle the click event for the start recording button
    startRecordingButton.addEventListener("click", () => {
        // Disable the start recording button and enable the stop recording button
        startRecordingButton.disabled = true;
        stopRecordingButton.disabled = false;
        rec_on.style.display='flex';
        // Get the audio from the user's microphone
        navigator.mediaDevices.getUserMedia({ audio: true }).then((stream) => {
            // Create a new MediaRecorder
            mediaRecorder = new MediaRecorder(stream);

            // Start recording
            mediaRecorder.start();

            // Create an array to hold the recorded audio data
            let recordedData = [];

            // Handle the dataavailable event, which is triggered when new audio data is available
            mediaRecorder.addEventListener("dataavailable", (event) => {
                recordedData.push(event.data);
            });

            // Handle the stop event, which is triggered when the recording is stopped
            mediaRecorder.addEventListener("stop", () => {
                // Create a new Blob containing the recorded audio data
                let audioBlob = new Blob(recordedData);
                
                // Create a new object URL for the recorded audio
                let audioUrl = URL.createObjectURL(audioBlob);
                // Set the audio element's src to the recorded audio URL
                recordedAudio.src = audioUrl;
                button_dl.href = audioUrl;
                
                // Enable the start recording button and disable the stop recording button
                startRecordingButton.disabled = false;
                stopRecordingButton.disabled = true;
                rec_on.style.display='none';
                button_container.style.display="flex";
            });
        });
    });
    // Handle the click event for the stop recording button
    stopRecordingButton.addEventListener("click", () => {
        // Stop the MediaRecorder
        mediaRecorder.stop();
    });

    function downloadName(){
        var name = new Date();
        var res = name.toISOString().slice(0,10);
        button_dl.download = 'Registrazione-'+res+'.wav';
    }
</script>