<?php

namespace app\core\controller;

use app\core\model\dto\UsuarioDTO;
use app\core\controller\base\BaseController;
use app\core\controller\base\InterfaceController;
use app\core\service\UsuarioService;
use app\libs\http\Request;
use app\libs\http\Response;

final class UsuarioController extends BaseController implements InterfaceController{
    
    private $service;

    public function __construct($scripts = [])
    {
        parent::__construct($scripts);
        $this->service = new UsuarioService();
    }


    public function index(Request $request, Response $response):void{

    }
    public function load(Request $request, Response $response):void
    {
        $dto = $this->service->load((Int)$request->getId());
        $response->setResult($dto->toArray());
        $response->send();

    }
    public function create(Request $request, Response $response):void
    {
        
    } 
    public function save(Request $request, Response $response):void
    {
        $dto = new UsuarioDTO($request->getDataFromInput());
        $this->service->save($dto);

        $response->setMessage("<p>Se agregó un nuevo usuario al sistema.</p>");
        $response->send();
    }
    public function edit(Request $request, Response $response):void{

    }
    public function update(Request $request, Response $response):void{
        $dto = new UsuarioDTO($request->getDataFromInput());
        $this->service->update($dto);

        $response->setMessage("<p>Se actualizó el usuario correspondiente.</p>");
        $response->send();
    }
    public function delete(Request $request, Response $response):void{

        //guardamos en un dto el usuario correspondiente, el id viene en la URL con metodo GET
        $dto = $this->service->load(((Int)$request->getId()));

        $this->service->delete($dto);

        $response->setMessage("<p>Se eliminó el usuario correspondiente.</p>");
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