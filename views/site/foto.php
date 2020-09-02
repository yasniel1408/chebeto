<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'SELECT FOTO';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-3 col-md-3"></div>
    <div class="col-lg-6 col-md-6">
<div class="modal-body">

    <?php $form = \yii\widgets\ActiveForm::begin(
        [
            'method' => 'post',
            'enableClientValidation' => true,
            'options' => [
                'enctype' => 'multipart/form-data',
            ]

        ]
    ); ?>

    <?php
    echo $form->field($signup, 'foto')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['multiple' => false, 'accept' => 'image/*'],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'showUpload' => true,
        ],
    ]);
    ?>


    <?= Html::submitButton(Yii::t('app', 'Actualizar'), ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

    </div>
    <div class="col-lg-3 col-md-3"></div>
</div>