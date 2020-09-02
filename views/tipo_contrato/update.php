<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo_contrato */

$this->title = 'Actualizar Tipo de Evento: ';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Evento', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>

<div class="row">
    <div class="col-lg-4 col-md-4"></div>
    <div class="col-lg-4 col-md-4">
<div class="tipo-contrato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formu', [
        'model' => $model,
    ]) ?>

</div>

</div>
<div class="col-lg-4 col-md-4"></div>
</div>
