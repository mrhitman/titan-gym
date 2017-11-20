<?php

$container = $app->getContainer();

$container["logger"] = function ($c) {
    $settings = $c->get("settings")["logger"];
    $logger = new Monolog\Logger($settings["name"]);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings["path"], $settings["level"]));
    return $logger;
};

$container["view"] = function ($c) {
    $settings = $c->get("settings")["twig"];
    $view = new \Slim\Views\Twig($settings["template_path"], [
        "cache" => $settings["cache"],
    ]);

    $basePath = rtrim(str_ireplace("index.php", "", $c["request"]->getUri()->getBasePath()), "/");
    $view->addExtension(new \Slim\Views\TwigExtension($c["router"], $basePath));

    return $view;
};

$container["db"] = function ($c) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($c['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
