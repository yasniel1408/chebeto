<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = 'Actualizar Evento: ';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>

<div class="row">
    <div class="col-lg-3 col-md-3"></div>
    <div class="col-lg-6 col-md-6">
        <div class="evento-update">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_formeditar', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
    <div class="col-lg-3 col-md-3"></div>
</div>