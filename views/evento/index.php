<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
Modal::begin([
    'header' =>$this->title,
    'id'     =>'modal',
    'size'   =>'modal-md',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo  "<div id='modalContent'>".                        "<div class='text-center'>".                        Html::img('@web/img/ajax.gif',['id' => 'loader','width' => '60']).                        "</div>".                   "</div>";
Modal::end();
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'value' => function($model, $key, $index, $column){
                return \kartik\grid\GridView::ROW_COLLAPSED;
            },
            'detail' => function($model, $key, $index, $column){

                return Yii::$app->controller->renderPartial('ver_todo_evento',[
                    'model' => $model,
                ]);
            }
        ],

        'nombre',
        [
            'attribute' => 'tipo_contrato_id',
            'value' => 'tipoContrato.nombre',
            'format' => 'raw',
            'width' => '200px',
            'filter' => \kartik\select2\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'tipo_contrato_id',
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Tipo_contrato::find()->all(), 'id', 'nombre'),
                'language' => 'es',
                'hideSearch' => false,
                'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Seleccione ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'required'=>true,
                    'multiple' => false,
                ],
                'addon' => [
                    'prepend' => [
                        'content' => \yii\bootstrap\Html::icon('list-alt')
                    ],

                ],
            ]),
        ],
        'equipo',
        'estado',
        'fecha_contrato',
        'fecha_evento',
        'fecha_fin',
        [
            'attribute' => 'allday',
            'value' => 'allday',
            'format' => 'raw',
            'width' => '100px',
            'filter' => \kartik\select2\Select2::widget([
                'model' => $searchModel,
                'attribute' => 'allday',
                'data' => \yii\helpers\ArrayHelper::map(\app\models\Evento::find()->all(), 'allday', 'allday'),
                'language' => 'es',
                'hideSearch' => false,
                'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Seleccione ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'required'=>true,
                    'multiple' => false,
                ],
                'addon' => [
                    'prepend' => [
                        'content' => \yii\bootstrap\Html::icon('list-alt')
                    ],

                ],
            ]),
        ],

        [
            'class' => 'kartik\grid\ActionColumn',
            //'dropdown' => true,
            'vAlign'=>'middle',
            'width'=>'150px',
            'template' => '{update}  {delete}',
        ],
    ],
    'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
    'export'=>[
        'fontAwesome'=>true
    ],
    'toolbar' =>  [
        ['content'=>
//            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['value'=>Url::to(['create']), 'class' => 'btn btn-success custom_button', 'title' => 'Crear nuevo evento', 'id'=>'modalButton']).' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Refrescar'])
        ],
        '{export}',
        '{toggleData}'
    ],
    'pjax' => false,
    'bordered' => true,
    'striped' => false,
    'condensed' => false,
    'responsive' => true,
    'hover' => true,
    'perfectScrollbar' => true,
    //'floatHeader' => true,
    'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
    //'showPageSummary' => true,
    'panel' => [
        'type' => GridView::TYPE_PRIMARY,
        'heading'=>'<i class="glyphicon glyphicon-edit"></i>',
    ],
]); ?>
</div>

