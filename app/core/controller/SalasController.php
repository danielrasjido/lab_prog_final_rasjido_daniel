<?php

namespace app\core\controller;

use app\core\model\dto\SalasDTO;
use app\core\controller\base\BaseController;
use app\core\controller\base\InterfaceController;
use app\core\service\SalasService;
use app\libs\http\Request;
use app\libs\http\Response;

final class SalasController extends BaseController implements InterfaceController{
    
    private $service;

    public function __construct($scripts = [])
    {
        parent::__construct($scripts);
        $this->service = new SalasService();
    }

    public function index(Request $request, Response $response):void{
        array_push($this->scripts, "/app/js/salas/index.js");

        $this->setCurrentView($request);
        require_once APP_FILE_TEMPLATE;
    }

    public function load(Request $request, Response $response):void
    {
        $dto = $this->service->load((Int)$request->getId());
        $response->setResult($dto->toArray());
        $response->send();

    }

    public function create(Request $request, Response $response):void
    {
        throw new \Exception("Método no implementado todavia");
    }

    public function save(Request $request, Response $response):void
    {
        $dto = new SalasDTO($request->getDataFromInput());
        $this->service->save($dto);

        $response->setMessage("<p>Se agregó una nueva sala al sistema.</p>");
        $response->send();
    }

    public function edit(Request $request, Response $response):void
    {
        throw new \Exception("Método no implementado todavia");
    }

    public function update(Request $request, Response $response):void
    {
        $dto = new SalasDTO($request->getDataFromInput());
        $this->service->update($dto);

        $response->setMessage("<p>Se actualizó la sala correspondiente.</p>");
        $response->send();
    }

    public function delete(Request $request, Response $response):void
    {
        //guardamos en un dto la sala correspondiente, el id viene en la URL con metodo GET
        $dto = $this->service->load(((Int)$request->getId()));

        $this->service->delete($dto);

        $response->setMessage("<p>Se eliminó la sala correspondiente.</p>");
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

    
    public function enable(Request $request, Response $response): void
    {
        $dto = $this->service->load((Int)$request->getId());
        $this->service->enable($dto);

        $response->setMessage("<p>Se habilitó la sala correspondiente.</p>");
        $response->send();
    }

    public function disable(Request $request, Response $response): void
    {
        $dto = $this->service->load((Int)$request->getId());
        $this->service->disable($dto);

        $response->setMessage("<p>Se deshabilitó la sala correspondiente.</p>");
        $response->send();
    }

}