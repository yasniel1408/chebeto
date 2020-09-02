<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

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
        'email:email',
        'rol',
        'username',
        // 'password',
        // 'salt',

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
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['value'=>Url::to(['create']), 'class' => 'btn btn-success custom_button', 'title' => 'Crear nuevo usuario', 'id'=>'modalButton']).' '.
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
        'heading'=>'<i class="glyphicon glyphicon-user"></i>',
    ],
]); ?>
</div>