<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'cache2' => [
            'class' => 'yii\caching\MemCache',
            'servers' =>  [
                [
                    'host' => 'localhost', // sesuaikan dengan server kamu
                    'port' => 11211, // default port
                    'weight' => 100, // saya gagal faham disini
                ],
            ], 

        ]
    ],
];
