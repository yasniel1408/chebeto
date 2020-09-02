<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\SigAsPersona;
use app\models\UserPersona;
use app\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UserPersona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $sql = "select * from public.user where id not in (select user_persona.id_user from user_persona)";
        $tmp = User::findBySql($sql)->all();
//    $tmp = User::find()->all();
        $arrayUsers = ArrayHelper::map($tmp,'id','username');
        echo  $form->field($model, 'id_user')->widget(
            Select2::className(),[
                'name' => 'id_user',
                'value' => '',
                'data' => $arrayUsers,
                'options' => ['multiple' => false, 'placeholder' => 'Seleccione asignaturas ...']
            ]
        );
    ?>

    <?php
        $sql = "SELECT sig_as_persona.id_persona,CONCAT (sig_as_persona.nombre,' ',sig_as_persona.apellido1,' ',sig_as_persona.apellido2) AS nombre
FROM sig_as_persona where sig_as_persona.id_persona not in (select id_persona from public.user_persona)";
        $tmp = SigAsPersona::findBySql($sql)->all();
        $arrayPers = ArrayHelper::map($tmp,'id_persona','nombre');
    ?>
    <?= $form->field($model, 'id_persona')->widget(
        Select2::className(),[
            'name' => 'id_persona',
            'value' => '',
            'data' => $arrayPers,
            'options' => ['multiple' => false, 'placeholder' => 'Seleccione asignaturas ...']
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
