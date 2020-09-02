<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notificaciones */

$this->title = Yii::t('app', 'Create Notificaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notificaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
