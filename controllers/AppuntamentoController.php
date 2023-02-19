<?php

namespace app\controllers;

use app\models\Appuntamento;
use app\models\AppuntamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppuntamentoController implements the CRUD actions for appuntamento model.
 */
class AppuntamentoController extends Controller
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
     * Lists all Appuntamento models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AppuntamentoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Appuntamento model.
     * @param int $id_date Id Data
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_date)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_date),
        ]);
    }

    /**
     * Creates a new Appuntamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Appuntamento();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect('/appuntamento/index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Appuntamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_data Id Data
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_date)
    {
        $model = $this->findModel($id_date);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_date' => $model->id_date]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Appuntamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_data Id Data
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_date)
    {
        $this->findModel($id_date)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Appuntamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_data Id Data
     * @return Appuntamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_date)
    {
        if (($model = Appuntamento::findOne(['id_date' => $id_date])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
