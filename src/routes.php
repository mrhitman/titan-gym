<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response, array $args) {
    $this->logger->info($request->getRequestTarget());
    $plans = $this->db->query('select * from `plans`')->fetchAll();
    $onetimeTraining = $this->db->query('select `value` from `config` where `name` = "onetime_training"')->fetch();
    return $this->view->render($response, 'index.html', [
        'plans' => $plans,
        'onetime_training' => $onetimeTraining['value'],
    ]);
});

$app->get('/admin', function (Request $request, Response $response, array $args) {
    $this->logger->info($request->getRequestTarget());
    return $this->view->render($response, 'admin/index.html');
});

$app->get('/admin/login', function (Request $request, Response $response, array $args) {
    $this->logger->info($request->getRequestTarget());
    return $this->view->render($response, 'admin/login.html');
});