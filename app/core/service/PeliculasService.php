<?php

namespace app\core\service;

use app\core\service\base\InterfaceService;
use app\core\model\dto\base\InterfaceDto;
use app\core\model\dto\PeliculasDTO;
use app\core\model\dao\PeliculasDAO;
use app\libs\database\Connection;

final class PeliculasService implements InterfaceService{

    private PeliculasDAO $dao;

    public function __construct()
    {
        $this->dao = new PeliculasDAO(Connection::get());
    }
   

    public function load(int $id):InterfaceDto{
        $data = $this->dao->load($id);
        if($data === false){
            throw new \Exception("Pelicula no encontrada.");
        }

        return new PeliculasDTO($data);
    }
    public function save(InterfaceDto $dto):void{
        $this->dao->save($dto->toArray());
    }
    public function update(InterfaceDto $dto):void{
        $this->dao->update($dto->toArray());
    }
    public function delete(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $id = $data['idPelicula'];
        $this->dao->delete($id);
    }
    public function list(array $filters):array{
        return $this->dao->list($filters);
    }
}