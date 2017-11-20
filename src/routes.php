<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Xandros15\SlimPagination\Pagination;

$app->get('/', function (Request $request, Response $response, array $args) {
    $db = $this->db;
    /* @var $db Illuminate\Database\Capsule\Manager */

    $config = $db
        ->table('config')
        ->where(['name' => 'onetime_training'])
        ->first();

    return $this->view->render($response, 'index.html', [
        'plans' => $db->table('plan')->get(),
        'onetime_training' => $config->value,
        'pagination' => new Pagination($request, $this->get('router'), [
            Pagination::OPT_TOTAL => $db->table('comment')->count(),
        ]),
        'comments' => $db->table('comment')->limit(10),
    ]);
});

$app->group('/comment', function () {
    $this->get('/page/:page', function (Request $request, Response $response, array $args) {
    });
    $this->post('/like/:id', function (Request $request, Response $response, array $args) {
    });
    $this->post('/dislike/:id', function (Request $request, Response $response, array $args) {
    });
});

$app->group('/admin', function () {
    $this->get('/', function (Request $request, Response $response, array $args) {
        return $this->view->render($response, 'admin/index.html');
    });
    $this->group('/plans', function () {
        $this->get('/', function (Request $request, Response $response, array $args) {
            $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */

            return $this->view->render($response, 'admin/plan/index.html', [
                'plans' =>  $db->table('plan')->get(),
            ]);
        });
        $this->get('/add/', function (Request $request, Response $response, array $args) {
            $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */
            return $this->view->render($response, 'admin/plan/_form.html');
        });
        $this->get('/:id/', function (Request $request, Response $response, array $args) {
            $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */
            $id = $args['id'];

            return $this->view->render('/admin/plan.html', [
                'plan' => $db->table('plan')->find($id)->first(),
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
            $db->table('plan')->delete($id);
            return $this->view->redirect('/admin/plans');
        });
    });
    $this->group('/config', function () {
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
