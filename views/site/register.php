<?php

/** @var yii\web\View $this */

use yii\web\View;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use app\assets\AppAsset;
$this->title = 'Registrazione';
AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html>
    <head>
    <!-- <script src="@web/js/script.js"></script> -->
    </head>
<?php   $this->beginBody()?>
    <body>
        <div class="site-register mt-4">
            <h2>
                <?= Html::encode($this->title) ?>
            </h2>

            <p>Compila il modulo di registrazione come caregiver o come logopedista:</p>

            <?php $registerForm = ActiveForm::begin([
                'id' => 'register-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control','style' => 'width:95%; margin-left:1em;'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>
            <div>
                <h3>Tipo di utente</h3>
                <input id="care" type="reset" value="Caregiver" class="register-button-style" onclick="switch_caregiver(this)">
                <input id="logo" type="reset" value="Logopedista" class="register-button-style" onclick="switch_logopedista(this)">
            </div>
            <?= $registerForm->errorSummary($newUser)?>
            <?= $registerForm->field($newUser, 'email')->textInput() ?>
            <?= $registerForm->field($newUser, 'password')->passwordInput() ?>
            <?= $registerForm->field($newUser, 'name')->textInput() ?>
            <?= $registerForm->field($newUser, 'surname')->textInput() ?>
            <?= $registerForm->errorSummary($newCaregiver)?>
            <div id="caregiver" style="display:none">
            <?= $registerForm->field($newCaregiver, 'mobile_phone')->textInput() ?>
            </div>
            <div id="logopedista" style="display:none">
            <?= $registerForm->field($newLogopedista, 'mobile_phone')->textInput() ?>
            <?= $registerForm->field($newLogopedista, 'address')->textInput() ?>
            <?= $registerForm->field($newLogopedista, 'specs')->textInput() ?>
            </div>

            <div class="form-group">
                <div class="">
                <?= Html::submitButton('Registrati', ['class'=> 'btn btn-primary', 'name'=> 'register-button'])?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="pt-2" style="color:#999;">
                <p>Hai già un account? <a style="margin-left: 0.5rem" href="/site/login">Accedi</a> </p>
            </div>
        </div>
    </body>
    <?php $this->endBody()?>
</html>
<?php $this->endPage()?>