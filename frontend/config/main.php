<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    //Instead of using site index as default page
    'defaultRoute' => '/video/index',
    'layout' => 'auth',
    // the "log" component must be loaded during bootstrapping time
    'bootstrap' => ['log'],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\module',
            'allowedIPs' => ['*']
        ],
        'debug' => [
            'class' => 'yii\debug\module',
            'allowedIPs' => ['*']
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            //This is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            //During development, it is often desirable to see where each log message is coming from.
            //3 if YII_DEBUG is on and 0 if YII_DEBUG is off.
            //This means, if YII_DEBUG is on, each log message will be appended with at most 3 levels of the call stack at which the log message is recorded; 
            //and if YII_DEBUG is off, no call stack information will be included.
            //Yii::debug('Logging test.', __METHOD__);
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //Change url from '.../video/view?video_id=zhWgPWjH' to .../video/view/zhWgPWjH
                'v/<id>' => 'video/view',
                'c/<username>' => 'channel/view',
            ],
        ],
        //Updates css automatically to avoid cached css.
        'assetManager' => [
            'appendTimestamp' => true,
        ]
    ],
    'params' => $params,
];
