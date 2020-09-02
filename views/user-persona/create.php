<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserPersona */

$this->title = 'Asignar un Usuario a una Persona';
$this->params['breadcrumbs'][] = ['label' => 'User Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-persona-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
