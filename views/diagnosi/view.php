<?php
use yii\filters\AccessControl;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\DetailView;
use app\models\Referto;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\controllers\RefertoController;

/** @var yii\web\View $this */
/** @var app\models\Diagnosi $model */

$this->title = $model->name_diagnosi;
\yii\web\YiiAsset::register($this);
?>
<div class="diagnosi-view mt-5">
    <a class="back-button" href="/site/index">Indietro</a>
    <h2><?= Html::encode($this->title) ?></h2>
    <br>
    <?php
        $user_type= (new \yii\db\Query)
            ->select(['*'])
            ->from('logopedista')
            ->where(['logopedista.user_key' => Yii::$app->user->identity->id_user]);
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $user_type,
            ]);
            $count = $user_type->count();

        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('referto')
            ->where(['diagnosi_id' =>$model->id_diagnosi]);
        $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
            ]);
        $records = $query->all();
        foreach ($records as $record) {
            echo Html::beginTag('h5', ['style' => 'margin-top:0.5em']);
            echo 'Referto : '.$record['name_referto'];
            echo Html::endTag('h5');
            echo Html::beginTag('div',['class' => 'referto-card']);
            echo Html::beginTag('div',['class' => 'custom-div']);
            echo $record['descr'];
            echo Html::endTag('div');
            if ($count>0) {
                echo Html::a(
                    '<span class="delete-button" style="text-decoration:none;">Cancella Referto</span>',
                    ['/referto/delete','id_referto' => $record['id_referto']],
                    [
                        'data-confirm' => 'Siete sicuri di voler cancellare il referto?',
                        'data-method' => 'post',
                    ]
                );
            echo Html::a(
                '<span class="basic-button" >Aggiorna Referto</span>',
                ['/referto/update','id_referto' => $record['id_referto']],
                [
                    'data-method' => 'post',
                ]
            );
            }
            echo Html::endTag('div');
        }
    ?>
    <?php
        $query = (new \yii\db\Query)
        ->select(['*'])
        ->from('user')
        ->join('INNER JOIN', 'logopedista', 'logopedista.user_key = '.Yii::$app->user->identity->id_user);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);
        $count = $query->count();
    if ($count>0) {
        echo Html::beginTag('br');
        echo Html::beginTag('br');
        echo Html::beginTag('h5');
        echo 'Nuovo Referto';
        echo Html::endTag('h5');
        echo Html::a('Aggiungi', '/referto/create', ['class' => 'back-button edit-float']);
    }
    ?>
    
</div>
