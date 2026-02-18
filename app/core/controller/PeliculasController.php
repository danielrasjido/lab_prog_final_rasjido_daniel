<?php

namespace app\core\controller;

use app\core\model\dto\PeliculasDTO;
use app\core\controller\base\BaseController;
use app\core\controller\base\InterfaceController;
use app\core\service\PeliculasService;
use app\libs\http\Request;
use app\libs\http\Response;

final class PeliculasController extends BaseController implements InterfaceController{
    private $service;

    public function __construct($scripts = [])
    {
        parent::__construct($scripts);
        $this->service = new PeliculasService();
    }


    public function index(Request $request, Response $response):void{

    }
    public function load(Request $request, Response $response):void{
        $id = $request->getId();
        $data = $this->service->load($id);
        $result = $data->toArray();

        $response->setResult($result);
        $response->send();
    }
    public function create(Request $request, Response $response):void{

    }
    public function save(Request $request, Response $response):void{
        $dto = new PeliculasDTO($request->getDataFromInput());
        $this->service->save($dto);

        $response->setMessage("<p>Se añadió una nueva película al sistema.</p>");
        $response->send();
    }
    public function edit(Request $request, Response $response):void{

    }
    public function update(Request $request, Response $response):void{
        $dto = new PeliculasDTO($request->getDataFromInput());
        $this->service->update($dto);

        $response->setMessage("<p>Se actualizó la pelicula correctamente.</p>");
        $response->send();
    }
    public function delete(Request $request, Response $response):void{
        $id = (int)($request->getId() ?? 0);

        if($id <= 0){
            $data = $request->getDataFromInput() ?? [];
            $id = (int)($data['idPelicula'] ?? 0);
        }

        if($id <= 0){
            throw new \Exception("Debe enviar un id válido para eliminar una película.");
        }

        $dto = $this->service->load($id);
        $this->service->delete($dto);

        $response->setMessage("<p>Se eliminó la pelicula correspondiente.</p>");
        $response->send();
    }
    public function list(Request $request, Response $response):void{
        $filtros = [];
        $resultados = [];

        $filtros = $request->getDataFromInput();
        $resultados = $this->service->list($filtros);


        $response->setResult($resultados);
        $response->send();
    }

}