<?php

namespace app\controllers;

use app\models\Referto;
use app\models\RefertoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefertoController implements the CRUD actions for Referto model.
 */
class RefertoController extends Controller
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
     * Lists all Referto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RefertoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Referto model.
     * @param int $id_referto Id Referto
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_referto)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_referto),
        ]);
    }

    /**
     * Creates a new Referto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Referto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect('/diagnosi/index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Referto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_referto Id Referto
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_referto)
    {
        $model = $this->findModel($id_referto);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_referto' => $model->id_referto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Referto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_referto Id Referto
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_referto)
    {
        $this->findModel($id_referto)->delete();

        return $this->redirect(['/diagnosi/index']);
    }

    /**
     * Finds the Referto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_referto Id Referto
     * @return Referto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_referto)
    {
        if (($model = Referto::findOne(['id_referto' => $id_referto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
