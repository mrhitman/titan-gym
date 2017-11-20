<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'twig' => [
            'template_path' => __DIR__ . '/../templates/',
            'cache' => false
        ],
        'logger' => [
            'name' => 'titan-gym',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'driver' => 'mysql',
            'host' => '10.10.51.161',
            'port' => 3310,
            'database' => 'titan-gym',
            'username' => 'root',
            'password' => 'pass4mysql',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
    ],
];
