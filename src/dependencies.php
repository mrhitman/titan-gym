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
    $db = $c["settings"]["db"];
    $pdo = new PDO("mysql:host=" . $db["host"] . ";dbname=" . $db["dbname"] . ";port=" . $db["port"] . ";charset=utf8",
        $db["user"], $db["password"]);
    $pdo->exec("set names utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
