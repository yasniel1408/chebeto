<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use dektrium\user\widgets\UserMenu;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/**
 * @var dektrium\user\models\User $user
 */

$u = Yii::$app->user->identity;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php $user = \app\models\Profile::findOne(['user_id' => $u->id]); ?>
            <?php if($user->foto) {
                echo \yii\helpers\Html::img('@web/fotoperfil/' . $user->foto, [
                    'class' => 'img',
                    'width' => '220',
                ]);
            }else{
                echo \yii\helpers\Html::img('@web/fotoperfil/user.png', [
                    'class' => 'img',
                    'width' => '220',
                ]);
            }
            ?>

        </h3>
    </div>
    <div class="panel-body">
        <?= UserMenu::widget() ?>
    </div>
</div>




