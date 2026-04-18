<?php

namespace app\core\controller;

use app\core\controller\base\BaseController;
use app\core\controller\base\InterfaceController;
use app\core\service\CatalogoService;
use app\libs\http\Request;
use app\libs\http\Response;

final class CatalogoController extends BaseController implements InterfaceController
{
    private $service;

    public function __construct($scripts = [])
    {
        parent::__construct($scripts);
        $this->service = new CatalogoService();
    }

    public function index(Request $request, Response $response): void
    {
        array_push($this->scripts, "/app/js/catalogo/index.js");

        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function entradas(Request $request, Response $response): void
    {
        array_push($this->scripts, "/app/js/catalogo/entradas.js");

        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function funciones(Request $request, Response $response): void
    {
        array_push($this->scripts, "/app/js/catalogo/funciones.js");

        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function create(Request $request, Response $response): void
    {
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function save(Request $request, Response $response): void
    {
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function edit(Request $request, Response $response): void
    {
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function update(Request $request, Response $response): void
    {
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function delete(Request $request, Response $response): void
    {
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function load(Request $request, Response $response): void
    {
        $idPelicula = (int)($request->getId() ?? 0);

        if ($idPelicula <= 0) {
            throw new \Exception("Debe indicar una película válida.");
        }

        $response->setResult($this->service->detalle($idPelicula));
        $response->send();
    }

    public function list(Request $request, Response $response): void
    {
        $filters = $request->getDataFromInput() ?? [];
        $response->setResult($this->service->list($filters));
        $response->send();
    }

    public function comentar(Request $request, Response $response): void
    {
        $data = $request->getDataFromInput() ?? [];
        $this->service->comentar($data, $this->obtenerUsuarioIdSesion());

        $response->setMessage("<p>Se registró el comentario correctamente.</p>");
        $response->send();
    }

    public function comprar(Request $request, Response $response): void
    {
        $data = $request->getDataFromInput() ?? [];
        $this->service->comprar($data, $this->obtenerUsuarioIdSesion());

        $response->setMessage("<p>La entrada se compró correctamente.</p>");
        $response->send();
    }

    public function misEntradas(Request $request, Response $response): void
    {
        $response->setResult($this->service->misEntradas($this->obtenerUsuarioIdSesion()));
        $response->send();
    }

    private function obtenerUsuarioIdSesion(): int
    {
        $idUsuario = (int)($_SESSION['usuarioId'] ?? 0);

        if ($idUsuario <= 0) {
            throw new \Exception("No hay un usuario autenticado en sesión.");
        }

        return $idUsuario;
    }
}
