<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserPersona */

$this->title = 'Update User Persona: ' . $model->id_user;
$this->params['breadcrumbs'][] = ['label' => 'User Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_user, 'url' => ['view', 'id_user' => $model->id_user, 'id_persona' => $model->id_persona]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-persona-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
