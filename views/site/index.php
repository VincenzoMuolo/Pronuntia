<?php
    use yii\grid\GridView;
    use app\models\Paziente;
    use yii\grid\DataColumn;
    use yii\helpers\Html;

    use app\assets\AppAsset;
    AppAsset::register($this);
    /** @var yii\web\View $this */

    $this->title = 'Pronuntia';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        .active{
            background-color:#30475E;
            border-radius:0.5em;
        }
        section{
            display:flex;
            flex-direction:row;
            align-items: center;
            justify-content: space-between;
            border-bottom: 0.25rem solid #111;
            padding:0.5rem;
        }
        .home-list {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display:flex;
            gap:1em;
            flex-wrap:wrap;
        }

        .home-list li {
            background-color: #121212;
            float: left;
            color:white;
            border-radius: 1em;
            transition: 300ms background-color ease-in;
        }

        .home-list li a {
            display: block;
            color: white;
            text-align: center;
            padding: 0.8rem 1rem;
            text-decoration: none;
            color:white;
        }

        .home-list li:hover {
            background-color: #30475E;
        }
        h3{
            float:right;
        }
        .hero-head{
            text-align:center;
        }
        .hero-text{
            width: calc(100% - 20vw);
            margin-inline:auto;
            margin-block:15vh;
            display:flex;
            flex-direction:column;
            text-align:center;
            font-size: calc(0.8rem + 0.5vw);
        }
        .spacing{
            margin-top:10vh;
        }
        .patient-container{
            margin-top:2em;
            display:grid;
            grid-template-columns: 45% 55%;
            grid-template-rows:25% auto;
        }
        h2{
            grid-column: 1;

        }
        .patient-list{
            grid-column: 1;
            grid-row: 2;
        }
        .patient-detail{
            grid-column: 2;
            grid-row-start: 1;
            grid-row-end: 3;
            width:90%;
            margin: 0 auto;
        }
        .button-color{
            background-color: #121212;
            border: none;
        }
        @media screen and (max-width: 768px){
            section{
                flex-direction:column;
            }
            h3{
                order: 1;
            }
            .home-list{
                order: 2;
            }
            .patient-container{
                grid-template-columns: 90%;
                grid-template-rows:15% auto;
                margin-left: 1em;
            }
            .patient-detail{
                grid-column: 1;
                grid-row-start: 3;
            }
        }
    </style>
    <body>
        <main class="site-index spacing">
        <?php if ($tipoUtente == 'caregiver'): ?>
        <section>
            <ul class="home-list">
                <li><a href="/paziente/create">Registra paziente</a></li>
                <li><a href="contact">Contatta logopedista</a></li>
                <li><a href="#contact">Prenota visita</a></li>
            </ul>
            <h3>Benvenuto/a, <?php echo Yii::$app->user->identity->name.' '.Yii::$app->user->identity->surname ?></h3>
        </section>
        <div class="patient-container">
            <h2>Pazienti</h2>
            <div class="patient-list">
                <?php
                    $paziente = new Paziente();
                    $caregiver_id = $paziente->sessionCaregiver();

                    if($caregiver_id!=null){
                        $query = (new \yii\db\Query)
                            ->select(['id_paziente','name', 'surname'])
                            ->from('paziente')
                            ->where(['caregiver_id' => $caregiver_id])
                            ->orderBy('name');
                            $dataProvider = new \yii\data\ActiveDataProvider([
                                'query' => $query,
                            ]);
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'summary' => '',
                            'columns' => [
                                [
                                    'attribute' => 'name',
                                    'header' => 'Nome',
                                ],
                                [
                                    'attribute' => 'surname',
                                    'header' => 'Cognome',
                                ],
                                [
                                    'class' => DataColumn::class,
                                    'format' => 'raw',
                                    'header' => 'Operazioni',
                                    'value' => function ($model) {
                                        return Html::a('Dettagli', ['/paziente/view?id_paziente='.$model['id_paziente']]);
                                    },
                                ],
                            ],
                        ]);
                    }
                ?>
            </div>
            <div class="patient-detail">
                <h2>Terapia in corso</h2><br>

            </div>
        </div>
        <?php elseif ($tipoUtente == 'logopedista'): ?>
            <h3>Benvenuto/a, <?php echo Yii::$app->user->identity->name.' '.Yii::$app->user->identity->surname ?></h3>
        <?php else: ?>
            <div class="hero-head">
                <h2>Benvenuto/a su Pronuntia. <?php echo $tipoUtente?></h2>
                <h4>Registrati o accedi per usare la piattaforma.</h4>
            </div>
            <div class="hero-text">
            <h2>Il nostro obiettivo</h2>
            <p>Pronuntia si impegna nel supportare pazienti affetti da disturbi fonetici e disturbi evolutivi del linguaggio.
                L’applicazione permette ad ogni paziente di essere seguito da una figura specializzata, il logopedista, il quale previa diagnosi,
                potrà somministrare terapie personalizzate con esercizi mirati a risolvere le problematiche riscontrate.
                L'accesso alla piattaforma del paziente è gestito dal caregiver, genitore o tutore, che dovrà far seguire la terapia al suo assistito e
                comunicare costantemente con il logopedista per fornirgli feedback sull'andamento ed eventualmente prenotare visite in ambulatorio.</p>
            </div>
        <?php endif; ?>
        </main>
    </body>
</html>
