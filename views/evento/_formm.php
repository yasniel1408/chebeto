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

    <?= $form->field($model, 'equipo')->textarea(['rows' => 2]) ?>
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 3]) ?>

    <div id="estadoEditar">
        <?php
        if($model->estado == 'Espera') {
            echo $form->field($model, 'estado')->dropDownList([
                'Espera' => 'Espera',
                'Realizado' => 'Realizado',
            ]);
        }else if($model->estado == 'Realizado'){
            echo $form->field($model, 'estado')->dropDownList([
                'Realizado' => 'Realizado',
                'Edición' => 'Edición',
            ]);
        }else if($model->estado == 'Edición'){
            echo $form->field($model, 'estado')->dropDownList([
                'Edición' => 'Edición',
                'Revisión' => 'Revisión',
            ]);
        }else if($model->estado == 'Revisión'){
            echo $form->field($model, 'estado')->dropDownList([
                'Revisión' => 'Revisión',
                'Impresión' => 'Impresión',
            ]);
        }else if($model->estado == 'Impresión') {
            echo $form->field($model, 'estado')->dropDownList([
                'Impresión' => 'Impresión',
                'Ampliación' => 'Ampliación',
            ]);
        }else if($model->estado == 'Ampliación') {
            echo $form->field($model, 'estado')->dropDownList([
                'Ampliación' => 'Ampliación',
                'Terminado' => 'Terminado'
            ]);
        }
    ?>
    </div>
    <?php
        echo 'Estado actual: '.$model->estado;
      ?>

    <br>
    <br>





<!--    <?//= $form->field($model, 'fecha_contrato')->widget(
//        \kartik\widgets\DateTimePicker::className(),[
//            'value' => date('yyyy-mm-dd hh:ii', strtotime('+2 days')),
//            'options' => [
//                    'placeholder' => 'Fecha de Contrato...',
//                    'id' => 'fecha_contrato_formulario_crear'
//                ],
//            'pluginOptions' => [
//                'format' => 'yyyy-mm-dd hh:ii',
//                'todayHighlight' => true
//            ]
//        ]
//    )
//    ?>-->

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

    <?= $form->field($model, 'allday')->textInput(['disabled'=>'true', 'id'=>'allday'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'data-confirm'=> Yii::t("app", "Usted está seguro de actualizar el siguiente evento: {item}?", ['item' => $model->nombre]),

        ]) ?>

        <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['/evento/deleteajax/?id='.$model->id],
            [
                'data-confirm'=> Yii::t("app", "Usted está seguro de eliminar el siguiente evento: {item}?", ['item' => $model->nombre]),
                'class' => 'btn btn-danger',
                'title'=>'Eliminar',
                'data-pjax' => '0'
            ]
        )
        ?>
    </div>



        <?php ActiveForm::end(); ?>

</div>
<?php
$arregloParaJS = json_encode($modelosCalendario);

$script = "

if($('#allday').val()=='SI'){
    $('#allday').val('SI')
    $('#fecha_evento_formulario_crear').addClass('hidden')
    $('#fecha_fin_formulario_crear').addClass('hidden')
}



";
$this->registerJs($script);
?>
