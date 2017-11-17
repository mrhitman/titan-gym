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
    ],
];
