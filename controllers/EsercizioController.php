<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use app\models\Esercizio;
use app\models\EsercizioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EsercizioController implements the CRUD actions for Esercizio model.
 */
class EsercizioController extends Controller
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
     * Lists all Esercizio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EsercizioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Esercizio model.
     * @param int $id_esercizio Id Esercizio
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_esercizio)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_esercizio),
        ]);
    }

    /**
     * Creates a new Esercizio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Esercizio();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $file = \yii\web\UploadedFile::getInstance($model, 'file');  
                if ($file) {
                    $fileName = $file->baseName . '.' . $file->extension;
                    $fileContents = file_get_contents($file->tempName);
                    $model->file_type = $fileName;
                    $model->file= $fileContents;
                }
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'Esercizio creato');            
                    return $this->redirect('/esercizio/index');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Esercizio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_esercizio Id Esercizio
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_esercizio)
    {
        $model = $this->findModel($id_esercizio);
        //File upload

        if ($this->request->isPost && $model->load($this->request->post())){
            $file = \yii\web\UploadedFile::getInstance($model, 'file');  
            if ($file) {
                $fileName = $file->baseName . '.' . $file->extension;
                $fileContents = file_get_contents($file->tempName);
                $model->file_type = $fileName;
                $model->file= $fileContents;
                Yii::$app->session->setFlash('success', $file->baseName.'   '.$file->extension);
            }
            if($model->save()) {
                return $this->redirect(['view', 'id_esercizio' => $model->id_esercizio]);
            }
        } 

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Esercizio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_esercizio Id Esercizio
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_esercizio)
    {
        $this->findModel($id_esercizio)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Esercizio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_esercizio Id Esercizio
     * @return Esercizio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_esercizio)
    {
        if (($model = Esercizio::findOne(['id_esercizio' => $id_esercizio])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
