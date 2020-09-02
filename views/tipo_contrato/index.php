<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Tipo_contratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Evento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-contrato-index">

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

        'nombre',
        [
            'attribute'=>'color',
            'value'=>function ($model, $key, $index, $widget) {
                return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" .
                    $model->color . '</code>';
            },
            'filterType'=>GridView::FILTER_COLOR,
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
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
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['value'=>Url::to(['create']), 'class' => 'btn btn-success custom_button', 'title' => 'Crear nuevo tipo de evento', 'id'=>'modalButton']).' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Refrescar'])
        ],
        '{export}',
        '{toggleData}'
    ],
    'pjax' => true,
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
        'heading'=>'<i class="glyphicon glyphicon-list-alt"></i>',
    ],
]); ?>
</div>