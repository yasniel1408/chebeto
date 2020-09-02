<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;port=3306;dbname=chebeto',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'schemaMap' => [
        'mysql'=> [
            'class'=>'yii\db\mysql\Schema',
            'defaultSchema' => 'public' //specify your schema here
        ]
    ],

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
