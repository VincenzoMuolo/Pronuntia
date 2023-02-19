<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use app\models\Diagnosi;
use app\models\DiagnosiSearch;
use app\models\Referto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DiagnosiController implements the CRUD actions for Diagnosi model.
 */
class DiagnosiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Diagnosi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DiagnosiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Diagnosi model.
     * @param int $id_diagnosi Id Diagnosi
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_diagnosi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_diagnosi),
        ]);
    }

    /**
     * Creates a new Diagnosi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Diagnosi();
        $modelR = new Referto();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                if ($modelR->load($this->request->post()) && $modelR->save()) {
                    Yii::$app->session->setFlash('success', 'Diagnosi Salvata');
                    /* $this->addIdDiagnosi(); */
                    $this->addNameDiagnosi();
                    return $this->redirect('/diagnosi/index');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model, 'modelR' =>$modelR,
        ]);
    }

    public function addIdDiagnosi() {
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('diagnosi')
            ->orderBy(['id_diagnosi' => SORT_DESC])
            ->limit(1);
            $records = $query->all();
            foreach ($records as $record) {
                $id=$record['id_diagnosi'];
            }
        $query2 = (new \yii\db\Query)
            ->select(['*'])
            ->from('referto')
            ->orderBy(['id_referto' => SORT_DESC])
            ->limit(1);
            $records2 = $query2->all();
            foreach ($records2 as $record2) {
                $id2=$record2['id_referto'];
            }
            $connection = Yii::$app->db;
            $command = $connection->createCommand()
                ->update('referto', ['diagnosi_id' => $id], 'id_referto = :id', [':id' => $id2])
                ->execute();
    }
    public function addNameDiagnosi() {
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('diagnosi')
            ->join('LEFT JOIN', 'paziente', 'paziente.id_paziente = diagnosi.paziente_id')
            ->orderBy(['id_diagnosi' => SORT_DESC])
            ->limit(1);
            $records = $query->all();
            foreach ($records as $record) {
                $id = $record['id_diagnosi'];
                $paziente = $record['name'].' '.$record['surname'];
            }
            $connection = Yii::$app->db;
            $command = $connection->createCommand()
                ->update('diagnosi', ['name_diagnosi' => 'Diagnosi '.$paziente], 'id_diagnosi = :id', [':id' => $id])
                ->execute();
    }

    /**
     * Updates an existing Diagnosi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_diagnosi Id Diagnosi
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_diagnosi)
    {
        $model = $this->findModel($id_diagnosi);
        $modelR = new Referto();
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_diagnosi' => $model->id_diagnosi]);
        }

        return $this->render('update', [
            'model' => $model, 'modelR' =>$modelR,
        ]);
    }

    /**
     * Deletes an existing Diagnosi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_diagnosi Id Diagnosi
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_diagnosi)
    {
        $this->findModel($id_diagnosi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Diagnosi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_diagnosi Id Diagnosi
     * @return Diagnosi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_diagnosi)
    {
        if (($model = Diagnosi::findOne(['id_diagnosi' => $id_diagnosi])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
