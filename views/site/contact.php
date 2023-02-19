<?php
    /** @var yii\web\View $this */
    use yii\grid\GridView;
    use yii\web\View;
    use yii\bootstrap5\ActiveForm;
    use yii\bootstrap5\Html;
    $user_type=Yii::$app->user->identity->id_user;
?>
<div class="contact mt-5">
    <a class="back-button" href="/site/index">Home</a>
    <?php
    
    $query = (new \yii\db\Query)
        ->select(['*'])
        ->from('logopedista')
        ->where(['logopedista.user_key' =>$user_type]);
    $isLogopedista = new \yii\data\ActiveDataProvider([
        'query' => $query,
    ]);
    if($query->count()){
        echo '<h2>';
        echo 'Contatta Caregiver';
        echo '</h2>';
        echo '<p>';
        echo 'Nella seguente pagina sono presenti i collegamenti a canali di comunicazione dei caregiver.'; 
        echo '</p>';
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'caregiver', 'user.id_user = caregiver.user_key')
            ->orderBy('name');
        $dataCaregiver = new \yii\data\ActiveDataProvider([
            'query' => $query,   
        ]);
        echo '<div class="pt-4">';
        echo GridView::widget([
            'dataProvider' => $dataCaregiver,
            'emptyText' => 'Nessun risultato trovato',
            'layout' => "{items}\n{pager}",
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
                'attribute' => 'email',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    return Html::mailto($dataProvider['email'], $dataProvider['email']);
                },
            ],
            [
                'attribute' => 'mobile_phone',
                'format' => 'raw',
                'header' => 'Numero telefonico',
                'value' => function ($dataProvider) {
                    return Html::a($dataProvider['mobile_phone'], 'tel:'.$dataProvider['mobile_phone']);
                },
            ],
        ],
    ]);
    }else {
        echo '<h2>';
        echo 'Contatta Logopedista';
        echo '</h2>';
        echo '<p>';
        echo 'Nella seguente pagina sono presenti i collegamenti a canali di comunicazione dei logopedisti.
            <br><b>Richiedi Test : </b> prima di iniziare un percorso terapeutico è possibile richiedere ad un logopedista un test al fine di comprendere lo stato del paziente.';
        echo '</p>';
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('user')
            ->join('INNER JOIN', 'logopedista', 'user.id_user = logopedista.user_key')
            ->orderBy('name');
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        echo '<div class="pt-4">';
        echo GridView::widget([
                'dataProvider' => $dataProvider,
                'emptyText' => 'Nessun risultato trovato',
                'layout' => "{items}\n{pager}",
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
                    'attribute' => 'specs',
                    'header' => 'Specializzazione',
                ],
                [
                    'attribute' => 'address',
                    'format' => 'raw',
                    'header' => 'Indirizzo',
                    'value' => function ($dataProvider) {
                        return Html::a($dataProvider['address'], 'https://www.google.com/maps?q=' . urlencode($dataProvider['address']));
                    },
                ],   
                [
                    'attribute' => 'email',
                    'format' => 'raw',
                    'value' => function ($dataProvider) {
                        return Html::mailto($dataProvider['email'], $dataProvider['email']);
                    },
                ],
                [
                    'attribute' => 'mobile_phone',
                    'format' => 'raw',
                    'header' => 'Numero telefonico',
                    'value' => function ($dataProvider) {
                        return Html::a($dataProvider['mobile_phone'], 'tel:'.$dataProvider['mobile_phone']);
                    },
                ],
            ],
        ]);
    }
    ?>
</div>
