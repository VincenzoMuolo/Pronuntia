<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Feedbackesercizio $model */

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<div class="feedbackesercizio-create mt-5 on-top">
    <?= Html::a('Indietro', 'javascript:history.back()', ['class' => 'back-button']); ?>
    <?php
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('esercizio')
            ->where(['id_esercizio'=>$id_esercizio]);
        $records = $query->all();
        foreach ($records as $record) {
            echo Html::beginTag('h2', ['class' => 'title-area centered']);
            echo $record['name_esercizio'];
            echo Html::endTag('h2');
            echo Html::beginTag('br');
            echo Html::beginTag('br');
            echo Html::beginTag('div',['class' => 'content-area resize-center padd w-background']);
            echo Html::beginTag('h5', ['class' => 'title-area']);
            echo "Descrizione Esercizio";
            echo Html::endTag('h5');
            echo Html::beginTag('p',['style' => 'margin:0; position:relative']);
            echo $record['descr'];
            echo Html::endTag('p');
            $base_file=$record['file'];
            echo Html::beginTag('h6', ['class' => 'title-area','style'=>'margin-top:1em;']);
            echo "<br><b>Durata ideale esercizio</b> ".$record['duration'].' minuti';
            echo Html::endTag('h6');

            if(str_contains($record['file_type'], ".wav")||
                str_contains($record['file_type'], ".mp3")){
                echo Html::beginTag('h5', ['class' => 'title-area','style'=>'margin-top:1em;']);
                echo "Allegato";
                echo Html::endTag('h5');
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
            else if(str_contains($record['file_type'], ".pdf")){
                echo Html::beginTag('h5', ['class' => 'title-area','style'=>'margin-top:1em;']);
                echo "Allegato";
                echo Html::endTag('h5');
                // Encode the binary PDF data as a base64 string
                $base64_pdf = base64_encode($base_file);

                // Create a data URL for the PDF data
                $data_url = 'data:application/pdf;base64,' . $base64_pdf;

                // Output the PDF data as an HTML <iframe> tag
                echo '<iframe src="' . $data_url . '" width="100%" height="500"></iframe>';
            }
            echo Html::endTag('div');
        }
    ?>


    <!-- AUDIO RECORDED -->
    <br>
    <div class="custom-div resize-center" style="box-shadow:none; padding:0" >
        <h4 style="margin:0 1.5em; padding-block:1.25em; position:relative; cursor:pointer;" onclick="hide()"> Registra Audio <span id="icon-more" class="material-symbols-outlined custom-arrow" >expand_more</span></h4>
        <div id="audio-detail" class="default-show hide">
            <p class="padd">
                In questa sezione è possibile registrare l'audio mentre viene svolto l'esercizio.
                L'utilizzo del registratore è opzionale, non siete costretti ad usarlo, però, soprattutto
                se il logopedista ve lo chiede potrebbe essere un utile strumento per permettergli
                di ottenere più informazioni sullo svolgimento dell'esercizio.
            </p>
            
            <div class="button-box">
                <!-- The button to start recording -->
                <button class="record-button" id="start-recording">Avvia Registrazione</button>
                
                <!-- The button to stop recording -->
                <button class="record-button" id="stop-recording" disabled>Ferma Registrazione</button>
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
    <div class="resize-center w-background" style="margin-top:1.5em; margin-bottom:6em">
    <h4 style=" padding-inline:1em; padding-block:1.25em; position:relative; cursor:pointer; margin:0" onclick="hide_descr()"> 
        Com'è andato l'esercizio?
        <span id="icon-more-2" class="material-symbols-outlined custom-arrow" >expand_more</span></h4>
        <div id="descr_area" class="hide" style="padding-inline:1em; padding-block:1.25em;">
            <?= $this->render('_form', [
                'model' => $model,
                'id_esercizio' =>$id_esercizio,
            ]) ?>
        </div>
    </div>
</div>



<script>
    
    function hide(){
        document.getElementById("icon-more").classList.toggle("active-arrow-switch");
        document.getElementById("audio-detail").classList.toggle("hide");
    }
    function hide_descr(){
        document.getElementById("icon-more-2").classList.toggle("active-arrow-switch");
        document.getElementById("descr_area").classList.toggle("hide");
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
        button_dl.download = 'Registrazione-'+res + '.wav';
    }
</script>