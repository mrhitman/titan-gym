<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response, array $args) {
    $this->logger->info($request->getRequestTarget());
    return $this->view->render($response, 'index.html', $args);
});

$app->get('/admin', function (Request $request, Response $response, array $args) {
    $this->logger->info($request->getRequestTarget());
    return "hello";
});