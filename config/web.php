<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'name'=>'CHEBETO STUDIO',
    'bootstrap' => ['log'],
    'language' => 'es',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'scmr893wytc8n923y9x2y98tcy2n38cry',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,

        ],
//        'user' => [
//            'identityClass' => 'mdm\admin\models\User',
//            'enableAutoLogin' => true,
//            'loginUrl' => 'admin/user/login',
//        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/site/pasaravistonoti/<id>' => '/site/pasaravistonoti',
                '/site/pasaravistonotitodo' => '/site/pasaravistonotitodo'
            ],
        ],

        'authManager'=>[
            'class'=>'dektrium\rbac\components\DbManager',
        ],

    ],

    // 'as access' => [
    //     'class' => 'mdm\admin\components\AccessControl',
    //     'allowActions' => [
    //         'site/*',
    //         'admin/*',
    //         // The actions listed here will be allowed to everyone including guests.
    //         // So, 'admin/*' should not appear here in the production, of course.
    //         // But in the earlier stages of your development, you may probably want to
    //         // add a lot of actions here until you finally completed setting up rbac,
    //         // otherwise you may not even take a first step.
    //     ]
    // ],

    'params' => $params,

    'modules' => [
//    	'estipendio' => [
//    		'class' => 'app\modules\Estipendio\Module',
//    	],
//    	'cienciatecnica' => [
//    		'class' => 'app\modules\Ciencia_Tecnica\Module',
//    	],
//    	'dietapagosmenores' => [
//    		'class' => 'app\modules\Dieta_PagosMenores\Module',
//    	],
//    	'gestiondepartamento' => [
//    		'class' => 'app\modules\Gestion_Departamento\Module',
//    	],
//        'relacionesinternacionales' => [
//            'class' => 'app\modules\Relaciones_Internacionales\Module',
//        ],


//        'admin'=>[
//            'class'=>'mdm\admin\Module',
//            'layout'=>'left-menu',
//            'mainLayout' => '@app/views/layouts/main.php',
//        ],
        'gridview'=>[
            'class'=>'\kartik\grid\Module'
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins'=>['admin'],
            'viewPath' =>'@app/views/user'
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
            'admins'=>['admin']
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
