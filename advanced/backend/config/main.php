<?php

$params = array_merge(
        require(__DIR__ . '/../../common/config/params.php'), 
        #require(__DIR__ . '/../../common/config/params-local.php'), 
        require(__DIR__ . '/params.php')
        #require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'homeUrl'=>array('/admin'),
    'components' => [
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
            'enableAutoLogin' => false,
            'authTimeout' => 18600, //Seconds
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['warning'],
                    'prefix' => function ($message) {
                $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
                $userID = $user ? $user->getId(false) : '-';
                return "[$userID]";
            },
                    'exportInterval' => 1,
                    'logFile' => '@runtime/logs/error.log',
                ],
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'prefix' => function ($message) {
                $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
                $userID = $user ? $user->getId(false) : '-';
                return "[$userID]";
            },
                    'exportInterval' => 1,
                    'logFile' => '@runtime/logs/scorepesa_info.log',
                ],
                'file' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'prefix' => function ($message) {
                $user = Yii::$app->has('user', true) ? Yii::$app->get('user') : null;
                $userID = $user ? $user->getId(false) : '-';
                return "[$userID]";
            },
                    'exportInterval' => 1,
                    'logFile' => '@runtime/logs/app.log',
                ],
                'email' => [
                    'class' => 'yii\log\EmailTarget',
                    'except' => ['yii\web\HttpException:404'],
                    'levels' => ['error'],
                    'message' => ['from' => 'robot@scorepesa-admin.com', 'to' =>
                    'rubewafula@gmail.com'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'amqp' => [
            'class' => 'iviu96afa\amqp\components\Amqp',
            'host' => 'pr-mq-1', //'127.0.0.1',
            'port' => 5672,
            'user' => 'scorepesa', //'guest',
            'password' => 'nywira18', //'guest',
            'vhost' => '/',
        ]
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            //'admin/*',
            'some-controller/some-action',
        // The actions listed here will be allowed to everyone including guests.
        // So, 'admin/*' should not appear here in the production, of course.
        // But in the earlier stages of your development, you may probably want to
        // add a lot of actions here until you finally completed setting up rbac,
        // otherwise you may not even take a first step.
        ]
    ],
    'modules' => [
        'admin' => ['class' => 'mdm\admin\Module'],
        'reportico' => [
            'class' => 'reportico\reportico\Module',
            'controllerMap' => [
                'reportico' => 'reportico\reportico\controllers\ReporticoController',
                'mode' => 'reportico\reportico\controllers\ModeController',
                'ajax' => 'reportico\reportico\controllers\AjaxController',
            ]
        ],
    ],
    'params' => $params,
];
