<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\Caregiver;
use app\models\Logopedista;
use app\models\Prenotazione;
use app\models\Prenotazionesearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'test-me' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $idUtenteAttivo = Yii::$app->user->id;

        if($idUtenteAttivo!=null){
            $user_id = User::findOne($idUtenteAttivo);
            
            $query = (new \yii\db\Query())
                ->select(['user.id_user'])
                ->from('user')
                ->join('INNER JOIN', 'caregiver', 'user.id_user = caregiver.user_key')
                ->where(['caregiver.user_key' => $user_id]);
                $caregiver = $query->all();
            if($caregiver!=null){
                return $this->render('index', [
                    'tipoUtente' => 'caregiver',
                ]);
            }
            $query = (new \yii\db\Query())
                ->select(['user.id_user'])
                ->from('user')
                ->join('INNER JOIN', 'logopedista', 'user.id_user = logopedista.user_key')
                ->where(['logopedista.user_key' => $user_id]);
                $logopedista = $query->all();
            if($logopedista!=null){
                return $this->render('index', [
                    'tipoUtente' => 'logopedista',
                ]);
            }
        }
        return $this->render('index', [
            'tipoUtente' => null,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Accesso eseguito!');
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $newUser = new User();
        $newCaregiver = new Caregiver();
        $newLogopedista = new Logopedista();
        if ($newUser->load(Yii::$app->request->post()) && $newUser->save()) {
            if ($newCaregiver->load(Yii::$app->request->post()) && $newCaregiver->save()) {
                Yii::$app->session->setFlash('success', 'Registrazione effettuata!');
                return $this->goHome();
            }
            else if ($newLogopedista->load(Yii::$app->request->post()) && $newLogopedista->save()) {
                Yii::$app->session->setFlash('success', 'Registrazione effettuata!');
                return $this->goHome();
            }
        }
        return $this->render('register', [
            'newUser' => $newUser, 'newCaregiver' => $newCaregiver,'newLogopedista' => $newLogopedista,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('contact');
    }

    public function block_date(){
        
        $query = (new \yii\db\Query)
            ->select(['*'])
            ->from('appuntamento')
            ->join('INNER JOIN', 'prenotazione', 'Appuntamento.id_date = prenotazione.date_id')
            ->orderBy(['id_prenotazione' => SORT_DESC])
            ->limit(1);
            $records = $query->all();
            foreach ($records as $record) {
                $id=$record['id_date'];
            }
            $connection = Yii::$app->db;
            $command = $connection->createCommand()
                ->update('appuntamento', ['state' => 'occupato'], 'id_date = :id', [':id' => $id])
                ->execute();
    }

    public function actionBook_appointment(){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $newPrenotazione = new Prenotazione();
        $newPrenotazioneSearch = new PrenotazioneSearch();
        if ($newPrenotazione->load(Yii::$app->request->post()) && $newPrenotazione->save()) {
            Yii::$app->session->setFlash('success', 'Prenotazione effettuata!');
            $this->block_date();
            return $this->goHome();
        }
        if ($newPrenotazioneSearch->load(Yii::$app->request->post()) && $newPrenotazioneSearch->save()) {
        }
        return $this->render('book_appointment', [
            'newPrenotazione' => $newPrenotazione,'newPrenotazioneSearch' => $newPrenotazioneSearch,
        ]);
    }
}