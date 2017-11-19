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
            'host' => '192.168.0.105',
            'port' => 3310,
            'user' => 'root',
            'password' => 'pass4mysql',
            'dbname' => 'titan-gym',
        ]
    ],
];
