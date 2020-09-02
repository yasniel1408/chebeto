<?php

namespace app\controllers;

use phpDocumentor\Reflection\Types\Integer;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Yii;
use app\models\Evento;
use app\models\EventoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        if (Yii::$app->user->can('ROLE_ESTILISTA')){
            throw new ForbiddenHttpException("No tiene permiso para ver este contenido");
        }
        return [
            'access' => [
                'class'     => AccessControl::className(),
                'only'      => [],
                'rules' => [
                    [
                        'actions'   => [],
                        'allow'     => true,
                        /*
                         * @        -> usuarios que han iniciado sesión
                         * ?        -> invitados (no ha iniciado sesión)
                         */
                        'roles'     => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Evento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->redirect('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateevento()
    {
        $perfil = \app\models\Profile::find()->where(['user_id' => Yii::$app->user->id])->one();
        date_default_timezone_set($perfil->timezone);
        $model = new Evento();
        $model->fecha_contrato = date('Y-m-d h:i');

        if ($model->load(Yii::$app->request->post())) {

            $dfs = new \DateTime();

            $parts = explode(' ',$model->fecha_fin);
            $fecha = $parts[0];
            $fechaPicada = explode('-', $fecha);
            $anyo = $fechaPicada[0];
            $mes = $fechaPicada[1];
            $dia = $fechaPicada[2];




            if($anyo < \date('Y') ||
                ( $anyo == \date('Y') && $mes < \date('m') ) ||
                (  $mes == \date('m') && $dia < (\date('d')+2) )){
                $model->estado = 'Terminado';
            }

            $model->save();

            return $this->redirect(['site/index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateajax($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['site/index']);
        } else {
            return $this->renderAjax('updateajax', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteajax($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
