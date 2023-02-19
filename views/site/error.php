<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\bootstrap5\Html;

$this->title = $name;
?>
<div class="site-error">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Il seguente errore si è verificato mentre il server stava processando la vostra richiesta
    </p>
    <p>
        Se il problema persiste contattateci, grazie.
    </p>

</div>
