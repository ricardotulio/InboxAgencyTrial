<?php

return [
    'app' => [
        'base_path' => getenv('BASE_URL')
    ],
    'container' => [
        'settings' => [
            'displayErrorDetails' => true
        ]
    ],
    'database' => [
        'dbname' => getenv('DB_NAME'),
        'user' => getenv('DB_USER'),
        'password' => getenv('DB_PASS'),
        'host' => getenv('DB_HOST'),
        'driver' => 'pdo_mysql'
    ],
    'mail' => [
    ],
    'view' => [
        'paths' => [
            __DIR__ . '/../src/views/'
        ],
        'cache' => false
    ]
];
