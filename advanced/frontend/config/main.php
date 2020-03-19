<?php

$params = array_merge(
       require(__DIR__ . '/../../common/config/params.php'), 
       #require(__DIR__ . '/../../common/config/params-local.php'), 
       require(__DIR__ . '/params.php') 
       #require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'SCOREPESA ADMIN PORTAL',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'loginUrl' => ['site/login'],
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 18600, //Seconds
        ],
        'mathCaptcha' => [ 
            'class' => 'common\components\MathCaptchaAction', 
        ],
        'log' => [
            'targets' => [
                     [
                       'class' => 'yii\log\FileTarget',
                       'levels' => ['info', 'warning'],
                       'categories' => ['debug'],
                       'logFile' => '@app/runtime/logs/app_debug.log',
                     ],
                     [
                        'class' => 'yii\log\FileTarget',
                        'levels' => ['trace', 'error'],
                        'categories' => ['error'],
                        'logFile' => '@app/runtime/logs/app_error.log',
                     ],
            ],
        ],
        'request' => [
            #'enableCookieValidation' => true,
            #'enableCsrfValidation' => true,
            'cookieValidationKey' => 'kajasyeuANKNDKGwggw820782bjwd67122w9=0839=v7dnskd',
        ],


        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'amqp' => [
            'class' => 'devmustafa\amqp\components\Amqp',
            'host' => '35.233.103.126', //'127.0.0.1',
            'port' => 5672,
            'user' => 'scorepesa', //'guest',
            'password' => 'nywira18', //'guest',
            'vhost' => '/',
        ],

        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
                'kvgrid' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],]],
     'urlManager' => [
         'enablePrettyUrl' => true,
         'showScriptName' => false,
         'enableStrictParsing' => false,
         'rules' => [],
      ] 
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/signup',
            'site/reset',
            'site/logout',
            'site/reset-password',
            'site/captcha',
        //     'admin/*',  '*'
         //   'some-controller/some-action',
        // The actions listed here will be allowed to everyone including guests.
        // So, 'admin/*' should not appear here in the production, of course.
        // But in the earlier stages of your development, you may probably want to
        // add a lot of actions here until you finally completed setting up rbac,
        // otherwise you may not even take a first step.
        ]
    ],
    'modules' => [
        'admin' => ['class' => 'mdm\admin\Module'],
        'gridview' => [
            'class' => '\kartik\grid\Module',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvgrid/messages',
                'forceTranslation' => true
            ]
        ],
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
