    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <?php if(\app\models\Notificaciones::find()->where(['visto'=>0])->count() > 0){?>
            <span class="label label-danger"><?= \app\models\Notificaciones::find()->where(['visto'=>0])->count()?></span>
        <?php }?>
    </a>
    <ul style="width: 480px !important;" class="dropdown-menu">
        <li class="header">Usted tiene <?= \app\models\Notificaciones::find()->where(['visto'=>0])->count()?> notificaciones</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <?php
                $notificaciones = \app\models\Notificaciones::find()->where(['visto'=>0])->all();
                foreach ($notificaciones as $noti) {
                    ?>
                    <li>
                        <a href="<?= \yii\helpers\Url::to(['site/pasaravistonoti/'.$noti->id]) ?>">
                            <i class="fa fa-warning text-yellow"></i> <?= $noti->descripcion?>
                        </a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </li>
        <li class="footer"><a href="<?= \yii\helpers\Url::to(['site/pasaravistonotitodo']) ?>">Quitar todo</a></li>
    </ul>
