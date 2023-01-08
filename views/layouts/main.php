<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title>
        Pronuntia
    </title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => 'Pronuntia',
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => ['style' => 'font-size:calc(1rem + 0.75vw); '],
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ','style'=>'margin-left:auto;'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                Yii::$app->user->isGuest ? '<li class="nav-item">' : ['label' => 'Profilo', 'url' => ['/site/login']],
                Yii::$app->user->isGuest ? ['label' => 'Registrati', 'url' => ['/site/register']] : '<li class=" nav-item" style="display:none;">',
                Yii::$app->user->isGuest ? ['label' => 'Accedi', 'url' => ['/site/login']] : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Esci',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ]
        ]);
        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
                <?= Alert::widget() ?>
                <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; Bunchcyde <?= date('Y') ?>
                </div>
                <div class="col-md-6 text-center text-md-end">Powered by Yii Framework</div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>