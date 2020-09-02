<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_contrato_id')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Tipo_contrato::find()->all(),'id','nombre'),
        'language' => 'es',
        'hideSearch' => false,
        'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP,
        'options' => ['placeholder' => 'Tipo de Evento'],
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
    ]) ?>

    <?= $form->field($model, 'equipo')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'estado')->dropDownList([
            'Espera' => 'Espera',
            'Realizado' => 'Realizado',
            'Edición' => 'Edición',
            'Revisión' => 'Revisión',
            'Impresión'=>'Impresión',
            'Ampliación' => 'Ampliación',
            'Terminado'=>'Terminado'
    ]) ?>





 <?= $form->field($model, 'fecha_contrato')->widget(
        \kartik\widgets\DateTimePicker::className(),[
            'value' => date('yyyy-mm-dd hh:ii', strtotime('+2 days')),
            'options' => [
                    'placeholder' => 'Fecha de Contrato...',
                    'id' => 'fecha_contrato_formulario_crear'
                ],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true
            ]
        ]
    )
    ?>

    <div id="fecha_evento_formulario_crear">
    <?= $form->field($model, 'fecha_evento')->widget(
        \kartik\widgets\DateTimePicker::className(),[
            'value' => date('yyyy-mm-dd hh:ii', strtotime('+2 days')),
            'options' => ['placeholder' => 'Fecha de Evento...',
                'id' => 'fecha_evento_formulario_crear_input'
            ],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true
            ]
        ]
    )
    ?>
    </div>

    <div id="fecha_fin_formulario_crear">
    <?= $form->field($model, 'fecha_fin')->widget(
        \kartik\widgets\DateTimePicker::className(),[
            'value' => date('yyyy-mm-dd hh:ii', strtotime('+2 days')),
            'options' => ['placeholder' => 'Fecha de Fin...',
                'id' => 'fecha_fin_formulario_crear_input'
            ],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true
            ]
        ]
    )
    ?>
    </div>

    <div class="hidden">
        <?= $form->field($model, 'allday')->textInput(['class'=>'', 'id'=>'allday'])?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
