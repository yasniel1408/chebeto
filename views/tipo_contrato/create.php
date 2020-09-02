<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tipo_contrato */

$this->title = 'Crear Tipo de Evento';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Contrato', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-contrato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
