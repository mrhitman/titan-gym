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
            'host' => '10.10.51.161',
            'port' => 3310,
            'user' => 'root',
            'password' => 'pass4mysql',
            'dbname' => 'titan-gym',
        ]
    ],
];
