<aside class="main-sidebar push">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php $user = \app\models\Profile::findOne(['user_id' => Yii::$app->user->id]); ?>
                <?php if($user->foto) {
                    echo \yii\helpers\Html::img('@web/fotoperfil/' . $user->foto, [
                        'class' => 'img-circle',
                    ]);
                }else{
                    echo \yii\helpers\Html::img('@web/fotoperfil/user.png', [
                        'class' => 'img-circle',
                    ]);
                }
                ?>

            </div>
            <div class="pull-left info">
                <p><?= $user->name?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> <?= $user->timezone ?></a>
            </div>

        </div>

        <?php
        if(!Yii::$app->user->isGuest && Yii::$app->user->can('ROLE_ADMIN') || Yii::$app->user->can('ROLE_SECRETARIA')){
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree', 'id'=>'Obuscar'],
                    'items' => [
                    ['label' => 'MENU CHEBETO', 'options' => ['class' => 'header']],

                    ['label' => 'Inicio', 'icon' => 'home', 'url' => ['/site/index']],

                    ['label' => 'Eventos', 'icon' => 'edit', 'url' => ['/evento']],

                    ['label' => 'Tipos de Eventos', 'icon' => 'file', 'url' => ['/tipo_contrato']],


                    // ['label' => 'Contratos', 'icon' => 'edit',
                    //     'items' => [
                    //         ['label' => 'Todos', 'icon' => 'edit', 'url' => ['/evento']],
                    //         ['label' => 'Confirmados', 'icon' => 'check', 'url' => ['/evento/confirmados']],
                    //         ['label' => 'Reservas', 'icon' => 'calendar', 'url' => ['/evento/reservas']],
                    //         ['label' => 'Papelera', 'icon' => 'trash-o', 'url' => ['/evento/papelera']],
                    //     ]
                    // ],
                    // ['label' => 'Personas', 'icon' => 'users',
                    //     'items' => [
                    //         ['label' => 'Personas', 'icon' => 'users', 'url' => ['/persona']],
                    //         ['label' => 'Escuelas', 'icon' => 'graduation-cap', 'url' => ['/escuela']],
                    //         ['label' => 'Trabajos', 'icon' => 'briefcase', 'url' => ['/trabajo']],
                    //         ['label' => 'Teléfonos', 'icon' => 'phone', 'url' => ['/telefono']],
                    //         ['label' => 'Correos', 'icon' => 'envelope-o', 'url' => ['/email']],
                    //     ]
                    // ],
                    // ['label' => 'Dirección', 'icon' => 'map',
                    //     'items' => [
                    //         ['label' => 'Dirección', 'icon' => 'map-o', 'url' => ['/direccion']],
                    //         ['label' => 'Paises', 'icon' => 'map-marker', 'url' => ['/pais']],
                    //         ['label' => 'Provincias', 'icon' => 'map-marker', 'url' => ['/provincia']],
                    //         ['label' => 'Municipios', 'icon' => 'map-marker', 'url' => ['/municipio']],
                    //         ['label' => 'Repartos', 'icon' => 'map-marker', 'url' => ['/reparto']],
                    //     ]
                    // ],
                    // ['label' => 'Studio', 'icon' => 'camera-retro',
                    //     'items' => [
                    //         ['label' => 'Eventos', 'icon' => 'calendar-check-o', 'url' => ['/evento']],
                    //         ['label' => 'Recomendaciones', 'icon' => 'credit-card', 'url' => ['/recomendacion']],
                    //         ['label' => 'Promociones', 'icon' => 'gift', 'url' => ['/promocion']],
                    //         ['label' => 'Vía Studio', 'icon' => 'hand-pointer-o', 'url' => ['/via_conocido_estudio']],
                    //         ['label' => 'No trabajo', 'icon' => 'dashboard', 'url' => ['/tiempo_no_trabajo']],
                    //     ]
                    // ],

                    ['label' => 'Base de Datos', 'icon' => 'database',
                        'items' => [
                            ['label' => 'Importar', 'icon' => 'download', 'url' => ['/../../phpmyadmin/db_import.php?db=chebeto']],
                            ['label' => 'Exportar', 'icon' => 'upload', 'url' => ['/../../phpmyadmin/db_export.php?db=chebeto']],
                        ]
                    ],

                    // ['label' => 'Configuración', 'icon' => 'cog',
                    //     'items' => [
                    //         ['label' => 'Tipos de Contratos', 'icon' => 'file', 'url' => ['/tipo_contrato']],
                    //         ['label' => 'Tipos de Teléfonos', 'icon' => 'phone', 'url' => ['/tipo_telefono']],
                    //         ['label' => 'Tipos de Correos', 'icon' => 'envelope-o', 'url' => ['/tipo_email']],
                    //         ['label' => 'Tipos de Escuelas', 'icon' => 'graduation-cap', 'url' => ['/tipo_escuela']],
                    //         ['label' => 'Ajustes', 'icon' => 'cog', 'url' => ['/configuracion']],
                    //         ['label' => 'Redes Sociales', 'icon' => 'facebook-f', 'url' => ['/redes_sociales']],
                    //     ]
                    // ],

                    // ['label' => 'Users Admin', 'icon' => 'user-plus','url' => ['/user/admin'],'visible' => Yii::$app->user->can('ROLE_ADMIN')],
                ],
            ]
        ); ?>

    </section>
    <?php
    }
    ?>
</aside>




<?php 
$script = <<< JS
    
    // $('#search').submit(function (e) {
    //     e.preventDefault()
    //    
    //     return false
    // })
    //
    // $('#searchI').keyup(function (e) {
    // 
    // })
    //
    // $('#searchI').focusin(function (e) {
    //     $('#Obuscar').fadeOut('slow').addClass('hidden')
    //     $('#buscar').fadeIn('slow').removeClass('hidden')
    // })
    // $('#searchI').focusout(function (e) {
    //     if($('#searchI').val() == ''){
    //         $('#buscar').fadeOut('slow').addClass('hidden')
    //         $('#Obuscar').fadeIn('slow').removeClass('hidden')
    //     }
    // })


JS;
$this->registerJs($script);
?>


