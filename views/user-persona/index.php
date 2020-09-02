<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserPersonaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asignación de Perfiles a los Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-persona-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    Modal::begin([
        'header' =>$this->title,
        'id'     =>'modal',
        'size'   =>'modal-lg',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo  "<div id='modalContent'>".                        "<div class='text-center'>".                        Html::img('@web/img/ajax.gif',['id' => 'loader','width' => '60']).                        "</div>".                   "</div>";
    Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute' => 'id_user',
                'value' => function($model){
                    return $model->idUser->username;
                },
            ],
            [
                'attribute' => 'id_persona',
                'value' => function($model){
                    return $model->idPersona->nombre.' '.$model->idPersona->apellido1.' '.$model->idPersona->apellido2;
                },
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                //'dropdown' => true,
                'vAlign'=>'middle',
                'width'=>'150px',
                'template' => '{view}  {delete}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        return Html::button('<span class="glyphicon glyphicon-eye-open"></span>',
                            ['value'=>Url::to(['user-persona/view','id_user'=>$model->id_user, 'id_persona'=>$model->id_persona]),
                                'class' => 'btn btn-default btn-xs custom_button', 'title'=>'Ver Asignación']);
                    },
                    'update' => function ($url, $model) {
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>',
                            ['value'=>Url::to(['user-persona/update', 'id_user'=>$model->id_user, 'id_persona'=>$model->id_persona]),
                                'class' => 'btn btn-info btn-xs custom_button', 'title'=>'Actualizar Asignación', 'data-toggle'=>'tooltip']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::button('<span class=" glyphicon glyphicon-trash"></span>',
                            ['value'=>Url::to(['user-persona/delete', 'id_user'=>$model->id_user, 'id_persona'=>$model->id_persona]),
                                'class' => 'btn btn-danger btn-xs custom_button', 'title'=>'Eliminar Asignación', 'data-toggle'=>'tooltip']);
                    },
                ],
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'export'=>[
            'fontAwesome'=>true
        ],
        'toolbar' =>  [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['value'=>Url::to(['user-persona/create']), 'class' => 'btn btn-success custom_button', 'title' => 'Crear nuevo user persona', 'id'=>'modalButton']).' '.
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
        //'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
        //'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading'=>'<i class="glyphicon glyphicon-user"></i> '.$this->title,
        ],
    ]); ?>
</div>
