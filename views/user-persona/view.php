<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserPersona */

$this->title = 'Perfil del usuario '.$model->idUser->username;
$this->params['breadcrumbs'][] = ['label' => 'User Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-persona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
              'label'=>'Usuario',
                'value'=> function($model){
                    return $model->idUser->username;
                }
            ],
            [
                'label'=>'Nombre',
                'value'=> function($model){
                    return $model->idPersona->nombre.' '.$model->idPersona->apellido1.' '.$model->idPersona->apellido2;
                }
            ],
            [
                'label'=>'Email',
                'value'=> function($model){
                    return $model->idPersona->email;
                }
            ],
            [
                'label'=>'Telefono',
                'value'=> function($model){
                    return $model->idPersona->telefono;
                }
            ],
            [
                'label'=>'Dirección',
                'value'=> function($model){
                    return $model->idPersona->direccion;
                }
            ],
            [
                'label'=>'Unidad organizativa',
                'value'=> function($model){
                    return $model->idUnidadorganizativa->nombre;
                }
            ],
        ],
    ]) ?>

</div>
