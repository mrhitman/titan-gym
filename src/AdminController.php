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

    /**
     * @var string
     */
    protected $table;

    public function __invoke()
    {
        $this->app->get("/", $this->index());
        $this->app->get("/{id}/", $this->get());
        $this->app->get("/delete/{id}/", $this->delete());
        $this->app->post("/create/", $this->create());
        $this->app->post("/", $this->update());
    }

    public function index()
    {
        $self = $this;
        return function (Request $request, Response $response) use ($self) {
            return $this->view->render($response, $request->getRequestTarget() . 'index.html', [
                'items' => $this->db->table($self->table)->get(),
            ]);
        };
    }

    public function get()
    {
        $self = $this;
        return function (Request $request, Response $response, $args) use ($self) {
            return $this->view->render($response, '/admin/' . $self->table . '/_form.html', [
                'item' => $this->db->table($self->table)->find($args['id']),
            ]);
        };
    }

    public function delete()
    {
        $self = $this;
        return function (Request $request, Response $response, array $args) use ($self) {
            $this->db
                ->table($self->table)
                ->find($args['id'])
                ->delete();
            return $response->withRedirect('/admin/' . $self->table . '/');
        };
    }

    public function create()
    {
        $self = $this;
        return function (Request $request, Response $response, array $args) use ($self) {
            $this->db
                ->table($self->table)
                ->insert($args);
            return $response->withRedirect('/admin/' . $self->table . '/');
        };
    }

    public function update()
    {
        $self = $this;
        return function (Request $request, Response $response, array $args) use ($self) {
            $item = $request->getParsedBody();
            $this->db->table($self->table)->where(['id' => $item['id']])->update($item);
            return $response->withRedirect($request->getRequestTarget() . $item["id"] . "/");
        };
    }
}