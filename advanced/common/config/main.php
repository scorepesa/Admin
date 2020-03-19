<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
          'db' => [
               'class' => 'yii\db\Connection',
               'dsn' => 'mysql:host=pr-db-1;dbname=scorepesa',
               'username' => 'admin',
              'password' => 'dJ_*YCKZrRsH9zhn^tf+~2.',
              'charset' => 'utf8',
         ],
           'slavedb' => [
               'class' => 'yii\db\Connection',
               'dsn' => 'mysql:host=pr-db-1;dbname=scorepesa',
               'username' => 'admin',
              'password' => 'dJ_*YCKZrRsH9zhn^tf+~2.',
              'charset' => 'utf8',
         ],
 
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kajasyeuANKNDKGwggw820782bjwd67122w9=0839=v7dnskd',
        ],


        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
