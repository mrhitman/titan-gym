<?php

use Slim\Http\Request;
use Slim\Http\Response;
use src\AdminController;
use Xandros15\SlimPagination\Pagination;

$app->get('/', function (Request $request, Response $response, array $args) {
    $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */

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
        'comments' => $db->table('comment')->where(['published' => 1])->limit(10)->get(),
    ]);
});

$app->group('/comment', function () {

    $this->get('/{page}', function (Request $request, Response $response, array $args) {
        $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */
        $comments = $db->table('comment')->get();
        var_dump($comments);
    });

    $this->get('/like/{id}', function (Request $request, Response $response, array $args) {
        $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */
        $comment = $db->table('comment')->find($args['id']);
        $comment->likes++;
        $db->table('comment')->where(['id' => $comment->id])->update((array) $comment);
        return $response->withRedirect('/');
    });

    $this->get('/dislike/{id}', function (Request $request, Response $response, array $args) {
        $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */
        $comment = $db->table('comment')->find($args['id']);
        $comment->likes--;
        $db->table('comment')->where(['id' => $comment->id])->update((array) $comment);
        return $response->withRedirect('/');
    });
});

$app->group('/admin', function () {
    $this->get('/', function (Request $request, Response $response, array $args) {
        return $this->view->render($response, 'admin/index.html');
    });

    $this->group('/plan', new AdminController([
        'app' => $this,
        'table' => 'plan',
    ]));

    $this->group('/config', new AdminController([
        'app' => $this,
        'table' => 'config',
    ]));
});
