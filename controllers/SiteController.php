<?php

namespace app\controllers;

use app\models\Contrato;
use app\models\Contrato_evento;
use app\models\Contrato_persona;
use app\models\ContratoEvento;
use app\models\ContratoSearch;
use app\models\Evento;
use app\models\EventoDinamicForm;
use app\models\EventoSearch;
use app\models\Notificaciones;
use app\models\Persona;
use app\models\PersonaDinamicForm;
use app\models\ProfileFoto;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionFoto(){
        $u = \Yii::$app->user->identity;
        $userP = \app\models\Profile::findOne(['user_id' => $u->id]);
        $signup = new ProfileFoto();

        //cambiar foto
        if ($signup->load(Yii::$app->request->post()) && $signup->validate()) {
            $signup->actualizarfoto($userP->user_id);
            return $this->render('index');
        }
        return $this->render('foto', [
            'signup' => $signup,
        ]);
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect('@web/user/login');
        } else{

            $searchModel = new EventoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        }
    }


    public function actionFormupdate(){
        $id = $_REQUEST["id"];
        $evento = Evento::findOne($id);
        return $this->renderAjax('formcrearcontrato', [
            'model' => $evento,
        ]);
    }


    public function actionVerificareventos(){
        $eventos = Evento::find()->all();
        foreach ($eventos as $e){
            if($e->estado=='Espera' && date('Y-m-d H:i',strtotime($e->fecha_fin)) < date('Y-m-d H:i')){
                $e->estado = 'Realizado';
                $e->save();
                $evento = $e->nombre;
                $noti = new Notificaciones();
                $noti->descripcion = "En el Evento ".$evento.' el estado ha sido modificado a Realizado';
                $noti->save();
            }
        }
        return true;
    }

    public function actionNotificacionesshow(){
        return $this->renderAjax('notificaciones');
    }

    public function actionPasaravistonoti($id){
        $n = Notificaciones::findOne($id);
        $n->visto = 1;
        $n->save();

        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPasaravistonotitodo(){
        $ns = Notificaciones::find()->where(['visto'=>0])->all();
        foreach ($ns as $n){
            $n->visto = 1;
            $n->save();
        }

        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionMover(){
        $id = $_REQUEST["inputFormularioIDMover"];
        $fecha_inicio = $_REQUEST["inputFormularioFechaInicio"];
        $fecha_fin = $_REQUEST["inputFormularioFechaFin"];

        $evento = Evento::findOne($id);
        $evento->fecha_evento = $fecha_inicio;
        $evento->fecha_fin= $fecha_fin;
        $evento->save();

        return $evento->nombre;
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
            return $this->goBack();
        }
        return $this->render(   'login', [
            'model' => $model,
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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
