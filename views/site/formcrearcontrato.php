<?php
/**
 * Created by PhpStorm.
 * User: LisiyTito
 * Date: 01/07/2019
 * Time: 9:53
 */
?>
<div class="contrato-form">
    <?php $form = \kartik\form\ActiveForm::begin(); ?>

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

    <?= $form->field($model, 'equipo')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'descripcion')->textarea(['rows' => 12]) ?>
    <?= $form->field($model, 'estado')->dropDownList([
        'Espera' => 'Espera',
        'Realizado' => 'Realizado',
        'Edición' => 'Edición',
        'Revisión' => 'Revisión',
        'Impresión'=>'Impresión',
        'Ampliación' => 'Ampliación',
        'Terminado'=>'Terminado'
    ]) ?>

    <?= $form->field($model, 'fecha_evento')->widget(
        \kartik\widgets\DateTimePicker::className(),[
            'value' => date('yyyy-mm-dd hh:ii', strtotime('+2 days')),
            'options' => ['placeholder' => 'Fecha de Evento...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true
            ]
        ]
    )
    ?>

    <?= $form->field($model, 'fecha_evento')->widget(
        \kartik\widgets\DateTimePicker::className(),[
            'value' => date('yyyy-mm-dd hh:ii', strtotime('+2 days')),
            'options' => ['placeholder' => 'Fecha de Evento...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true
            ]
        ]
    )
    ?>


    <?= $form->field($model, 'fecha_fin')->widget(
        \kartik\widgets\DateTimePicker::className(),[
            'value' => date('yyyy-mm-dd hh:ii', strtotime('+2 days')),
            'options' => ['placeholder' => 'Fecha de Fin...'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true
            ]
        ]
    )
    ?>


    <div class="form-group">
        <?= \yii\bootstrap\Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php \kartik\form\ActiveForm::end(); ?>

</div>

</div>

<?php
$script = <<< JS

// $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
//     console.log("beforeInsert");
// });
//
// $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
//     console.log("afterInsert");
// });
//
// $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
//     if (! confirm("Are you sure you want to delete this item?")) {
//         return false;
//     }
//     return true;
// });
//
// $(".dynamicform_wrapper").on("afterDelete", function(e) {
//     console.log("Deleted item!");
// });
//
// $(".dynamicform_wrapper").on("limitReached", function(e, item) {
//     alert("Limit reached");
// });

JS;
$this->registerJs($script);
?>
