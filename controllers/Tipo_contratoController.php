<?php

namespace app\controllers;

use Yii;
use app\models\Tipo_contrato;
use app\models\Tipo_contratoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Tipo_contratoController implements the CRUD actions for Tipo_contrato model.
 */
class Tipo_contratoController extends Controller
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
     * Lists all Tipo_contrato models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Tipo_contratoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tipo_contrato model.
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
     * Creates a new Tipo_contrato model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tipo_contrato();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tipo_contrato model.
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

    /**
     * Deletes an existing Tipo_contrato model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tipo_contrato model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tipo_contrato the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tipo_contrato::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
