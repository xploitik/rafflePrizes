<?php

return [
    'db' => [
        'host' => '192.168.48.2',
        "username" => "test_marsel",
        "password" => "test_marsel",
        "dbname" => "test_marsel",
        "port" => "3306",
    ],
    'raffle' => [
        'restrictions' => [
            'money' => [
                'min' => 10,
                'max' => 1000,
            ],
            'loyalty' => [
                'min' => 50,
                'max' => 200,
            ],
        ],
        'settings' => [
            'loyalty' => [
                'source' => 'raffle',
            ],
        ],
    ]
];