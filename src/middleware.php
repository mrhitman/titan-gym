<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->add(function (Request $request, Response $response, $next) {
    $this->logger->info($request->getRequestTarget());
    $response = $next($request, $response);
    return $response;
});

$app->add(new \Slim\Middleware\HttpBasicAuthentication([
    "path" => "/admin",
    "users" => [
        "admin" => "pass4titan",
    ]
]));