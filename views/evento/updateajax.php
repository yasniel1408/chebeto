<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipo_contrato */

$this->title = 'Actualizar Evento: ';
$this->params['breadcrumbs'][] = ['label' => 'Evento', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>

<div class="continer">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_formm', [
        'model' => $model,
    ]) ?>

</div>
