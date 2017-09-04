<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    // 'bootstrap' => [
    //     'queue', // The component registers own console commands
    // ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => 'dcb9\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'redis' => 'redis', // Redis connection component or its config
            'channel' => 'queue', // Queue channel key
            // Other driver options
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
