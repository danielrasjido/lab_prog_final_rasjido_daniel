<?php

namespace app\core\controller;

use app\core\model\dto\ComentariosDTO;
use app\core\controller\base\BaseController;
use app\core\controller\base\InterfaceController;
use app\core\service\ComentariosService;
use app\libs\http\Request;
use app\libs\http\Response;

final class ComentariosController extends BaseController implements InterfaceController{
    private $service;

    public function __construct($scripts = [])
    {
        parent::__construct($scripts);
        $this->service = new ComentariosService();
    }

    public function index(Request $request, Response $response):void{
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function load(Request $request, Response $response):void
    {
        $dto = $this->service->load((Int)$request->getId());
        $response->setResult($dto->toArray());
        $response->send();

    }

    public function create(Request $request, Response $response):void
    {
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function save(Request $request, Response $response):void
    {
        $dto = new ComentariosDTO($request->getDataFromInput());
        $this->service->save($dto);

        $response->setMessage("<p>Se agregó un nuevo comentario al sistema.</p>");
        $response->send();
    }

    public function edit(Request $request, Response $response):void{
        throw new \Exception("No se puede acceder a esta ruta.");
    }

    public function update(Request $request, Response $response):void{
        $dto = new ComentariosDTO($request->getDataFromInput());
        $this->service->update($dto);

        $response->setMessage("<p>Se actualizó el comentario correspondiente.</p>");
        $response->send();
    }

    public function delete(Request $request, Response $response):void{
        //guardamos en un dto el comentario correspondiente, el id viene en la URL con metodo GET
        $dto = $this->service->load(((Int)$request->getId()));

        $this->service->delete($dto);

        $response->setMessage("<p>Se eliminó el comentario correspondiente.</p>");
        $response->send();
    }

    public function list(Request $request, Response $response):void
    {
        $filters = $request->getDataFromInput();
        $result = $this->service->list($filters);
        $response->setResult($result);
        $response->send();
    }

}