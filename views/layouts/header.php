<?php
use yii\helpers\Html;
use dektrium\user\models\User;
use app\models\UserPersona;
use app\models\MstrNotificacion;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a(Html::img('@web/img/logo.png',['class'=>'logomini']) ."
    <span class='logo-lg'>" . Yii::$app->name , Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top"  role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <?php
        if (!Yii::$app->user->isGuest) { ?>
            <div class="navbar-custom-menu" >

                <ul class="nav navbar-nav" id="cuadrodeusuario">

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu" id="notificaciones">

                    </li>

                    <li class="dropdown user user-menu" >
                        <a href="#" class="dropdown-toggle"  data-toggle="dropdown">
                            <?php $user = \app\models\Profile::findOne(['user_id' => Yii::$app->user->id]); ?>
                            <?php if($user->foto) {
                                echo \yii\helpers\Html::img('@web/fotoperfil/' . $user->foto, [
                                    'class' => 'img-circle',
                                    'width' => '20',
                                ]);
                            }else{
                                echo \yii\helpers\Html::img('@web/fotoperfil/user.png', [
                                    'class' => 'img-circle',
                                    'width' => '20',
                                ]);
                            }
                            ?>
                            <span class="hidden-xs"><?php $user = \app\models\Profile::findOne(['user_id' => Yii::$app->user->id]); ?>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <?php $user = \app\models\Profile::findOne(['user_id' => Yii::$app->user->id]); ?>
                                <?php if($user->foto) {
                                    echo Html::img('@web/fotoperfil/' . $user->foto, [
                                        'class' => 'img-circle',
                                    ]);
                                }else{
                                    echo Html::img('@web/fotoperfil/user.png', [
                                        'class' => 'img-circle',
                                    ]);
                                }
                                $ruta =  Yii::$app->requestedRoute;
                                $veruser = explode('/',$ruta);
                                if($veruser[0] == 'user'){
                                    $dir = "http://$_SERVER[HTTP_HOST]".\yii\helpers\Url::to(["../site/foto"]);
                                }else{
                                    $dir = "http://$_SERVER[HTTP_HOST]".\yii\helpers\Url::to(["site/foto"]);
                                }
                                ?>
                                <p><a href="<?= $dir ?>" style="position: fixed; margin-top: -35px; margin-left: 20px; color: #d58512;"> <i class="glyphicon glyphicon-camera"></i></a></p>

                                <p>
                                    <?php $user = \app\models\Profile::findOne(['user_id' => Yii::$app->user->id]); ?>
                                    <?= $user->name; ?>
                                    -
                                    <?= Yii::$app->user->identity->username; ?>
                                    <small>Usuario creado
                                        el <?= date('d-M-Y', Yii::$app->user->identity->created_at) ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer" id="footerconcolor">
                                <div class="pull-right">
                                    <?= Html::a(
                                        'Salir',
                                        ['/site/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    ) ?>
                                </div>
                                <div class="pull-left">
                                    <?= Html::a(
                                        'Perfil',
                                        ['/user/settings'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    ) ?>
                                </div>

                            </li>

                        </ul>
                    </li>
                    <?php if(Yii::$app->user->can('ROLE_ADMIN')){ ?>
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        <?php } else {
            echo "<div class='navbar-custom-menu'><ul class='nav navbar-nav'><li class='dropdown messages-menu'>";
            echo "<a href='" . Yii::$app->urlManager->createUrl('/user/login', array()) . "'><i class='glyphicon glyphicon-user'></i> <span style='margin-left: 5px'>Login</span></a>";
            echo "</li></ul></div>";
        }
        ?>
    </nav>
</header>


<?php

$script = <<< JS

  var color =  $('.navbar').css('background-color');

  $('.panel-heading').css('background-color', color)
  $('.panel-heading').css('border-color', color)
  $('.panel-primary').css('border-color', color)
  
  setInterval(function(){
      
      $(document).ready()
      .find('#notificaciones')
      .load('/chebeto/web/site/notificacionesshow')
  },1000)


JS;
$this->registerJs($script);
?>









