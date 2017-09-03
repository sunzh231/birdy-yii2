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

    ],
];
