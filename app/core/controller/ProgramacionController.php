<?php

namespace app\core\controller;

use app\core\model\dto\ProgramacionDTO;
use app\core\controller\base\BaseController;
use app\core\controller\base\InterfaceController;
use app\core\service\ProgramacionService;
use app\libs\http\Request;
use app\libs\http\Response;

final class ProgramacionController extends BaseController implements InterfaceController{

    private $service;

    public function __construct($scripts = [])
    {
        parent::__construct($scripts);
        $this->service = new ProgramacionService();
    }

    public function index(Request $request, Response $response):void{
        throw new \Exception("Función no implementada.");
    }

    public function load(Request $request, Response $response):void
    {
        $dto = $this->service->load((Int)$request->getId());
        $response->setResult($dto->toArray());
        $response->send();

    }

    public function create(Request $request, Response $response):void
    {
        throw new \Exception("Función no implementada.");
    }

    public function save(Request $request, Response $response):void
    {
        $dto = new ProgramacionDTO($request->getDataFromInput());
        $this->service->save($dto);

        $response->setMessage("<p>Se agregó una nueva programación al sistema.</p>");
        $response->send();
    }

    public function edit(Request $request, Response $response):void
    {
        throw new \Exception("Función no implementada.");
    }

    public function update(Request $request, Response $response):void
    {
        $dto = new ProgramacionDTO($request->getDataFromInput());
        $this->service->update($dto);

        $response->setMessage("<p>Se actualizó la programación correspondiente.</p>");
        $response->send();
    }

    public function delete(Request $request, Response $response):void
    {
        //guardamos en un dto la programación correspondiente, el id viene en la URL con metodo GET
        $dto = $this->service->load(((Int)$request->getId()));

        $this->service->delete($dto);

        $response->setMessage("<p>Se eliminó la programación correspondiente.</p>");
        $response->send();
    }

    public function list(Request $request, Response $response):void
    {
        $filtros = [];
        $resultados = [];

        $filtros = $request->getDataFromInput();
        $resultados = $this->service->list($filtros);

        $response->setResult($resultados);
        $response->send();
    }
}