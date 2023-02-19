<?php
    use yii\grid\GridView;
    use app\models\Paziente;
    use yii\grid\DataColumn;
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;
    use app\assets\AppAsset;
    AppAsset::register($this);
    /** @var yii\web\View $this */

    $this->title = 'Pronuntia';

?>
<style>
    
</style>

<?php if ($tipoUtente == 'caregiver'): ?>
    <section class="mt-5">
        <ul class="home-list">
            <li><a href="/paziente/create">Registra paziente</a></li>
            <li><a href="/site/contact">Contatta logopedista</a></li>
            <li><a href="/site/book_appointment">Prenota visita</a></li>
            <li><a href="/feedbackesercizio/index">Area Paziente</a></li>
        </ul>
        <h3>Benvenuto/a, <?php echo Yii::$app->user->identity->name.' '.Yii::$app->user->identity->surname ?></h3>
    </section>
    <div class="patient-container">
        <div class="patient-top">
            <h2>Pazienti</h2>
            <?php
                $paziente = new Paziente();
                $caregiver_id = $paziente->sessionCaregiver();

                if($caregiver_id!=null){
                    $query = (new \yii\db\Query)
                        ->select(['id_paziente','name', 'surname','id_diagnosi'])
                        ->from('paziente')
                        ->join('LEFT JOIN', 'diagnosi', 'diagnosi.paziente_id = paziente.id_paziente')
                        ->where(['caregiver_id' => $caregiver_id])
                        ->orderBy('name');
                        $dataProvider = new \yii\data\ActiveDataProvider([
                            'query' => $query,
                        ]);
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => '',
                        'emptyText' => 'Nessun risultato trovato',
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
                            [
                                'class' => DataColumn::class,
                                'format' => 'raw',
                                'header' => 'Diagnosi',
                                'value' => function ($model) {
                                    if($model['id_diagnosi']!=null){
                                        return Html::a('Vedi', ['/diagnosi/view?id_diagnosi='.$model['id_diagnosi']]);
                                    }
                                    else{
                                        return Html::a('Nessun risultato');
                                    }
                                },
                            ],
                        ],
                    ]);
                }
            ?>
        </div>
        <div class="patient-top">
            <h2>Terapia in corso</h2>
            <?php
            $query = (new \yii\db\Query)
                ->select(['id_terapia','name_terapia','paziente.name','paziente.surname'])
                ->from('terapia')
                ->join('INNER JOIN', 'paziente', 'terapia.paziente_id = paziente.id_paziente')
                ->join('INNER JOIN', 'caregiver', 'paziente.caregiver_id = caregiver.id_caregiver')
                ->join('INNER JOIN', 'user', 'user.id_user = caregiver.user_key')
                ->where(['id_user'=>Yii::$app->user->identity->id_user]);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'emptyText' => 'Nessun risultato trovato',
                'columns' => [
                    [
                        'class' => DataColumn::class,
                        'format' => 'raw',
                        'header' => 'Terapia',
                        'value' => function ($model) {
                            return Html::a($model['name_terapia'], ['/terapia/viewprogress?id_terapia='.$model['id_terapia']]);
                        },
                    ],
                    [
                        'attribute' => 'name',
                        'header' => 'Nome Paziente',  
                    ],
                    [
                        'attribute' => 'surname',
                        'header' => 'Cognome Paziente',                          
                    ],
                ],                 
                ]);  
        ?>
        </div>
    </div>
    <br>
    <div class="patient-container">
        <div class="patient-bottom">
            <?php
                $query = (new \yii\db\Query)
                    ->select(['paziente.name AS pname', 'paziente.surname AS psurname', 'date','id_date'])
                    ->from('paziente')
                    ->join('INNER JOIN', 'prenotazione', 'prenotazione.paziente_id = paziente.id_paziente')
                    ->join('INNER JOIN', 'caregiver', 'paziente.caregiver_id = caregiver.id_caregiver')
                    ->join('INNER JOIN', 'user', 'user.id_user = caregiver.user_key')
                    ->join('INNER JOIN', 'appuntamento', 'prenotazione.date_id = appuntamento.id_date')
                    ->where(['id_user'=>Yii::$app->user->identity->id_user]);
                    $dataProvider = new \yii\data\ActiveDataProvider([
                        'query' => $query,
                    ]);
                $count = $query->count();
                if ($count>0) {
                    echo Html::beginTag('h2');
                    echo 'Prenotazioni';
                    echo Html::endTag('h2');
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => '',
                        'emptyText' => 'Nessun risultato trovato',
                        'columns' => [
                            [
                                'attribute' => 'pname',
                                'header' => 'Nome Paziente',  
                            ],
                            [
                                'attribute' => 'psurname',
                                'header' => 'Cognome Paziente',                          
                            ],                   
                            [
                                'attribute' => 'date',
                                'header' => 'Data Appuntamento',
                            ],
                        ],
                    ]);
                    echo Html::beginTag('div');
                    echo 'Qualora fosse necessario riprogrammare o disdire la prenotazione si prega di contattare il logopedista tramite i canali di comunicazione forniti dallo stesso.';
                    echo Html::endTag('div');
                }           
            ?>
        </div>
        <div class="patient-bottom">
            <?php
                $query = (new \yii\db\Query)
                    ->select(['id_test','name_test','paziente.name','paziente.surname'])
                    ->distinct()
                    ->from('test')
                    ->join('INNER JOIN', 'paziente', 'test.paziente_id = paziente.id_paziente')
                    ->join('INNER JOIN', 'caregiver', 'paziente.caregiver_id = caregiver.id_caregiver')
                    ->join('INNER JOIN', 'user', 'caregiver.user_key = '.Yii::$app->user->identity->id_user);
                    $dataProvider = new \yii\data\ActiveDataProvider([
                        'query' => $query,
                    ]);
                    $count = $query->count();
                if ($count>0) {
                    echo Html::beginTag('h2');
                    echo 'Test';
                    echo Html::endTag('h2');

                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => '',
                        'emptyText' => 'Nessun risultato trovato',
                        'columns' => [
                            [
                                'attribute' => 'name_test',
                                'header' => 'Test',  
                            ],
                            [
                                'attribute' => 'name',
                                'header' => 'Nome Paziente',                            
                            ],
                            [
                                'attribute' => 'surname',
                                'header' => 'Cognome Paziente',                          
                            ],
                            [
                                'class' => DataColumn::class,
                                'format' => 'raw',
                                'header' => 'Dettagli',
                                'value' => function ($model) {
                                    return Html::a('Visualizza', ['/test/viewfrompaziente?id_test='.$model['id_test']]);
                                },
                            ],
                        ],
                    ]);  
                } else { }
                echo Html::beginTag('br');
                echo Html::beginTag('br');
            ?>
        </div>
    </div>
    <?php elseif ($tipoUtente == 'logopedista'): ?>
        <section class="mt-5">
        <ul class="home-list">
            <li><a href="/appuntamento/index">Gestisci Agenda</a></li>
            <li><a href="/site/contact">Contatta Caregiver</a></li>
            <li><a href="/terapia/index">Terapie</a></li>
            <li><a href="/esercizio/index">Esercizi</a></li>
            <li><a href="/test/index">Test Pazienti</a></li>
            <li><a href="/diagnosi/index">Diagnosi</a></li>
        </ul>
        <h3>Benvenuto/a, <?php echo Yii::$app->user->identity->name.' '.Yii::$app->user->identity->surname ?></h3>
    </section>
    <div>
        <br><br>
        <h2>Pazienti in Terapia</h2>
        <?php
            $query = (new \yii\db\Query)
                ->select(['id_terapia','name_terapia','paziente.name','paziente.surname','id_diagnosi'])
                ->from('terapia')
                ->join('INNER JOIN', 'paziente', 'terapia.paziente_id = paziente.id_paziente')
                ->join('INNER JOIN', 'logopedista', 'terapia.logopedista_id = logopedista.id_logopedista')
                ->join('INNER JOIN', 'user', 'user.id_user = logopedista.user_key')
                ->join('LEFT JOIN', 'diagnosi', 'diagnosi.logopedista_id = logopedista.id_logopedista')
                ->where(['id_user'=>Yii::$app->user->identity->id_user]);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'emptyText' => 'Nessun risultato trovato',
                'columns' => [
                    [
                        'class' => DataColumn::class,
                        'format' => 'raw',
                        'header' => 'Terapia',
                        'value' => function ($model) {
                            return Html::a($model['name_terapia'], ['/terapia/view?id_terapia='.$model['id_terapia']]);
                        },
                    ],
                    [
                        'attribute' => 'name',
                        'header' => 'Nome Paziente',  
                    ],
                    [
                        'attribute' => 'surname',
                        'header' => 'Cognome Paziente',                          
                    ],
                    [
                        'class' => DataColumn::class,
                        'format' => 'raw',
                        'header' => 'Diagnosi',
                        'value' => function ($model) {
                            if($model['id_diagnosi']!=null){
                                return Html::a('Vedi', ['/diagnosi/view?id_diagnosi='.$model['id_diagnosi']]);
                            }else{
                                return Html::a('Nessun Risultato');
                            }
                        },
                    ],
                ],                 
                ]);  
        ?>
    </div>
    <br>
    <div>
        <h2>Prossimi Appuntamenti</h2>
            <?php
                $userId = Yii::$app->user->identity->id;

                $query = (new \yii\db\Query)
                    ->select(['paziente.name AS pname', 'paziente.surname AS psurname', 'date'])
                    ->from('paziente')
                    ->join('LEFT JOIN', 'prenotazione', 'prenotazione.paziente_id = paziente.id_paziente')
                    ->join('LEFT JOIN', 'logopedista', 'prenotazione.logopedista_id = logopedista.id_logopedista')
                    ->join('LEFT JOIN', 'user', 'user.id_user = logopedista.user_key')
                    ->join('LEFT JOIN', 'appuntamento', 'prenotazione.date_id = appuntamento.id_date')
                    ->where(['user.id_user'=>$userId]);
                    $dataProvider = new \yii\data\ActiveDataProvider([
                        'query' => $query,
                    ]);
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => '',
                    'emptyText' => 'Nessun risultato trovato',
                    'columns' => [
                        [
                            'attribute' => 'pname',
                            'header' => 'Nome Paziente',  
                        ],
                        [
                            'attribute' => 'psurname',
                            'header' => 'Cognome Paziente',                          
                        ],                  
                        [
                            'attribute' => 'date',
                            'header' => 'Data Appuntamento',
                        ],
                    ],
                ]);            
            ?>
    </div>
    <?php else: ?>
        <div class="hero-head mt-5">
            <h2>Benvenuto/a su Pronuntia. <?php echo $tipoUtente?></h2>
            <h4>Registrati o accedi per usare la piattaforma.</h4>
        </div>
        <div class="hero-text">
            <h2>Il nostro obiettivo</h2>
            <p>Pronuntia si impegna nel supportare pazienti affetti da disturbi fonetici e disturbi evolutivi del linguaggio.
                L’ applicazione permette ad ogni paziente di essere seguito da una figura specializzata, il logopedista, il quale previa diagnosi,
                potrà somministrare terapie personalizzate con esercizi mirati a risolvere le problematiche riscontrate.
                L'accesso alla piattaforma del paziente è gestito dal caregiver, genitore o tutore, che dovrà far seguire la terapia al suo assistito e
                comunicare costantemente con il logopedista per fornirgli feedback sull'andamento ed eventualmente prenotare visite in ambulatorio.</p>
        </div>
<?php endif; ?>

