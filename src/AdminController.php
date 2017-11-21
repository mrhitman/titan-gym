<?php

namespace src;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class AdminController extends Component
{
    /**
     * @var App
     */
    protected $app;
    protected $table;

    public function __invoke()
    {
        $this->app->get("/", $this->index());
        $this->app->get("/{id}/", $this->get());
        $this->app->get("/delete/{id}/", $this->delete());
    }

    public function index()
    {
        $self = $this;
        return function (Request $request, Response $response) use ($self) {
            return $this->view->render($response, $request->getRequestTarget() . 'index.html', [
                'items' => $this->db->table($self->table)->get()
            ]);
        };
    }

    public function get()
    {
        $self = $this;
        return function (Request $request, Response $response, $args) use ($self) {
            var_dump($this->db->table($self->table)->find($args['id']));
//            return $this->view->render($response, $request->getRequestTarget() . 'view.html');
        };
    }

    public function delete()
    {
        $self = $this;
        return function (Request $request, Response $response, array $args) use ($self) {
            return $response->withRedirect('/admin/' . $self->table . '/');
        };
    }
}