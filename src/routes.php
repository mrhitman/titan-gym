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

    $comments =  $db->table('comment')
        ->where(['comment.published' => 1])
        ->limit(10)
        ->get();

    $sections = $db->table('section')
        ->where(['active' => 1])
        ->orderBy('index')
        ->get();

    return $this->view->render($response, 'index.html', [
        'plans' => $db->table('plan')->get(),
        'onetime_training' => $config->value,
        'pagination' => new Pagination($request, $this->get('router'), [
            Pagination::OPT_TOTAL => $db->table('comment')->count(),
        ]),
        'comments' => $comments,
        'sections' => $sections,
    ]);
});

$app->group('/comment', function () {

    $this->post('/', function (Request $request, Response $response, array $args) {
        $item = $request->getParsedBody();
        $secretKey = "6LfCFDwUAAAAAJ5qrLwPG-bfErU3WJsfheawx8Fj";
        if (isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha) {
          return;
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret="
            . $secretKey."&response="
            . $captcha . "&remoteip=" 
            . $ip);
        $responseKeys = json_decode($response, true);
        if(intval($responseKeys["success"]) !== 1) {
          return;
        }
        $item['date'] = date('Y-m-d H:i:s');
        $this->db->table('comment')->insert($item);
        return $response->withJson($item);
    });

    $this->get('/{page}', function (Request $request, Response $response, array $args) {
        $db = $this->db; /* @var $db Illuminate\Database\Capsule\Manager */
        $comments = $db->table('comment')->get();
        var_dump($comments);
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

    $this->group('/comment', new AdminController([
        'app' => $this,
        'table' => 'comment',
    ]));

    $this->group('/section', new AdminController([
        'app' => $this,
        'table' => 'section',
    ]));
});
