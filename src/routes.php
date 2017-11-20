<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Xandros15\SlimPagination\Pagination;

$app->get('/', function (Request $request, Response $response, array $args) {
    $db = $this->db;
    /* @var $db Illuminate\Database\Capsule\Manager */

    $plans = $db
        ->table('plan')
        ->get();

    $onetimeTraining = $db
        ->table('config')
        ->where(['name' => 'onetime_training'])
        ->first();

    $comments = $db
        ->table('comment')
        ->limit(10);

    $commentCount = $db
        ->table('comment')
        ->count();

    return $this->view->render($response, 'index.html', [
        'plan' => $plans,
        'onetime_training' => $onetimeTraining->value,
        'pagination' => new Pagination($request, $this->get('router'), [
            Pagination::OPT_TOTAL => $commentCount,
        ]),
        'comments' => $comments,
    ]);
});

$app->group('/admin', function () use ($app) {
    $this->get('/', function (Request $request, Response $response, array $args) {
        return $this->view->render($response, 'admin/index.html');
    });
    $app->group('/plans', function () use ($app) {
        $this->get('/', function (Request $request, Response $response, array $args) {
            $db = $this->db;
            /* @var $db Illuminate\Database\Capsule\Manager */

            $plans = $db
                ->table('plan')
                ->get();

            return $this->view->render($response, 'admin/plans.html', [
                'plans' => $plans,
            ]);
        });
        $this->get('/:id/', function (Request $request, Response $response, array $args) {
            $db = $this->db;
            /* @var $db Illuminate\Database\Capsule\Manager */
            $id = $request->getAttribute('id');

            $plan = $db
                ->table('plan')
                ->find($id)
                ->first();

            return $this->view->render('/admin/plan.html', [
                'plan' => $plan,
            ]);
        });
        $this->post('/:id/', function (Request $request, Response $response, array $args) {
            $db = $this->db;
            /* @var $db Illuminate\Database\Capsule\Manager */
        });
        $this->get('/delete/:id/', function (Request $request, Response $response, array $args) {
            $db = $this->db;
            /* @var $db Illuminate\Database\Capsule\Manager */
            $id = $request->getAttribute('id');

            $db->table('plan')
                ->delete($id);

            return $this->view->redirect('/admin/plans');
        });
    });
    $app->group('/config', function () use ($app) {
        $this->get('/', function (Request $request, Response $response, array $args) {
            $db = $this->db;
            /* @var $db Illuminate\Database\Capsule\Manager */

            $config = $db
                ->table('config')
                ->get();

            return $this->view->render($response, '/admin/config.html', [
                'items' => $config,
            ]);
        });
    });
});
