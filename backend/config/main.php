<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
              'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
              'api/<controller:\w+>/<id:\d+>' => '<controller>/view',
              'api/<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
              'api/<controller:\w+>/<action:\w+>' => '<controller>/<action>',

              'api/modules/<module:\w+>/<controller:\w+>/<id:\d+>' => 'modules/<module>/<controller>/view',
              'api/modules/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => 'modules/<module>/<controller>/<action>',
              'api/modules/<module:\w+>/<controller:\w+>/<action:\w+>' => 'modules/<module>/<controller>/<action>',

              'api/<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
              'api/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
              'api/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
