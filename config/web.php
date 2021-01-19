<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
 //       '@admin' => '@vendor/almasaeed2010/adminlte/docs/assets',
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'bundles' => [
                'kartik\grid\GridView' => [
          //          'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
        'request' => [
//            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'NI6enDkEQ-Esl0ShcI-xNoiYi0g7HAOz',
            'class' => 'klisl\languages\Request',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
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
        //    'enableStrictParsing' => true,
        //    'class' => 'klisl\languages\UrlManager',

            'rules' => [
         //       '<action:(contact|login|logout|language|about|signup)>' => 'site/<action>',
          //      'languages' => 'ar/languages/common/',
         //       '/' => 'site/index',
                '<id:\d+>'                               => 'profile/show',
                '<action:(login|logout|auth)>'           => 'security/<action>',
                '<action:(register|resend)>'             => 'registration/<action>',
                'confirm/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'registration/confirm',
                'forgot'                                 => 'recovery/request',
                'recover/<id:\d+>/<code:[A-Za-z0-9_-]+>' => 'recovery/reset',
                'settings/<action:\w+>'                  => 'settings/<action>',



                //'job/<link:[\w-]+>' => 'showjob',
                'ajax/<action:\w+>' => 'ajax/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'  => '<controller>/<action>',

            ],
        ],

    ],
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module'],
        'languages' => [
            'class' => 'klisl\languages\Module',
            //Языки используемые в приложении
            'languages' => [
                'English' => 'en',
                'Arabic' => 'ar',
            ],
            'default_language' => 'en', //основной язык (по-умолчанию)
            'show_default' => false, //true - показывать в URL основной язык, false - нет
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
        ],
        'adminpanel' => [
            'class' => 'app\modules\administrator\Module',
        //    'layout' => '@app/modules/administrator/views/layouts/main'
        ],
    ],
    'params' => $params,

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
       // 'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
