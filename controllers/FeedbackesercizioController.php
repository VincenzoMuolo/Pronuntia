<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use app\models\Feedbackesercizio;
use app\models\FeedbackesercizioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * FeedbackesercizioController implements the CRUD actions for Feedbackesercizio model.
 */
class FeedbackesercizioController extends Controller
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
     * Lists all Feedbackesercizio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FeedbackesercizioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feedbackesercizio model.
     * @param int $id_feedback Id Feedback
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_feedback)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_feedback),
        ]);
    }

    public function actionShow_exercises($id_terapia)
    {
        return $this->render('show_exercises', [
            'id_terapia' => $id_terapia,
        ]);
    }


    /**
     * Creates a new Feedbackesercizio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_esercizio)
    {
        $model = new Feedbackesercizio();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $file = \yii\web\UploadedFile::getInstance($model, 'file');
                if ($file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $fileContents = file_get_contents($file->tempName);
                    $model->file_type = $fileName;
                    $model->file= $fileContents;
                }
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Esercizio completato');
                    return $this->redirect('/feedbackesercizio/index');
                }
                
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'id_esercizio' => $id_esercizio,
        ]);
    }

    /**
     * Updates an existing Feedbackesercizio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_feedback Id Feedback
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_feedback)
    {
        $model = $this->findModel($id_feedback);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_feedback' => $model->id_feedback]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Feedbackesercizio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_feedback Id Feedback
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_feedback)
    {
        $this->findModel($id_feedback)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Feedbackesercizio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_feedback Id Feedback
     * @return Feedbackesercizio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_feedback)
    {
        if (($model = Feedbackesercizio::findOne(['id_feedback' => $id_feedback])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
