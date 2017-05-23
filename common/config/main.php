<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'qiniu' => [
            'class' => 'dcb9\qiniu\Component',
            'accessKey' => 'YOUR_ACCESS_KEY',
            'secretKey' => 'YOUR_SECRET_KEY',
            'disks' => [
                'testBucket' => [
                    'bucket' => 'bucketOnQiniu',
                    'baseUrl' => 'ACCESS_QINIU_URL',
                    'isPrivate' => true,
                    'zone' => 'zone0', // 可设置为 zone0, zone1 @see \Qiniu\Zone
                ],
            ],
        ],
    ],
    'modules'=>[
        //other modules .....
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24,
            'storageMap' => [
                'user_credentials' => 'common\models\User',
            ],
            'grantTypes' => [
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true
                ]
            ]
        ]
    ],
];
