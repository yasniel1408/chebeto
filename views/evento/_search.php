<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EventoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>
<!---->
<!--    --><?//= $form->field($model, 'tipo_evento_id') ?>
<!---->
<!--    --><?//= $form->field($model, 'nombre') ?>
<!---->
<!--    --><?//= $form->field($model, 'fecha_evento') ?>
<!---->
<!--    --><?//= $form->field($model, 'fecha_evento') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'prereserva') ?>

    <?php // echo $form->field($model, 'anulado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
