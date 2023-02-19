<?php

namespace app\controllers;

use app\models\Paziente;
use app\models\PazienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PazienteController implements the CRUD actions for Paziente model.
 */
class PazienteController extends Controller
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
     * Lists all Paziente models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new PazienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paziente model.
     * @param int $id_paziente Id Paziente
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_paziente) {
        return $this->render('view', [
            'model' => $this->findModel($id_paziente),
        ]);
    }

    /**
     * Creates a new Paziente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Paziente();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect('/paziente/index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Paziente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_paziente Id Paziente
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_paziente) {
        $model = $this->findModel($id_paziente);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_paziente' => $model->id_paziente]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Paziente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_paziente Id Paziente
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_paziente) {
        $this->findModel($id_paziente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Paziente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_paziente Id Paziente
     * @return Paziente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_paziente) {
        if (($model = Paziente::findOne(['id_paziente' => $id_paziente])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
