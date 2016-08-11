<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
//    'modules' => [
//        'yii2images' => [
//            'class' => 'rico\yii2images\Module',
//            //be sure, that permissions ok
//            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
//            'imagesStorePath' => 'images/store', //path to origin images
//            'imagesCachePath' => 'images/cache', //path to resized copies
//            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
//            'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
//        ],
//    ],
    'defaultRoute' => 'home/index',
    'components' => [
        'authManager' => [
          'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'lDr3sh5DFni9hmJkYWdAia3JpnrbgLjW',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'loginUrl' => ['home/login']
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
