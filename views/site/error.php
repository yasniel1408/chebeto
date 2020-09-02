<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

if ($exception->statusCode===403){
    $this->title='Acceso Denegado';
}if($exception->statusCode===404){
    $this->title = 'Objeto no encontrado';
}

//$this->title = $name;
?>
    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $this->title ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                Por favor contacte con el administrador del sistema.
<!--                The above error occurred while the Web server was processing your request.-->
<!--                Please contact us if you think this is a server error. Thank you.-->
<!--                Meanwhile, you may <a href='--><?php ////= Yii::$app->homeUrl ?><!--'>return to dashboard</a> or try using the search-->
<!--                form.-->
            </p>
        </div>
    </div>

