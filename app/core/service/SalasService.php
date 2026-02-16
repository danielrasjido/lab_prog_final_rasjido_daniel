<?php

namespace app\core\service;

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\SalasDAO;
use app\core\model\dto\SalasDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;
use Exception;

final class SalasService implements InterfaceService{

    private SalasDAO $dao;

    public function __construct()
    {
        $this->dao = new SalasDAO(Connection::get());
    }

    public function load(int $id):InterfaceDto{

        $data = $this->dao->load($id);

        if($data === false){
            throw new \Exception("Sala no encontrada.");
        }

        return new SalasDTO($data);
    }

    public function save(InterfaceDto $dto):void{
        $this->dao->save($dto->toArray());
    }

    public function update(InterfaceDto $dto):void{
        $this->dao->update($dto->toArray());
    }

    public function delete(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $id = $data['idSala'];
        $this->dao->delete($id);
    }
    
    public function list(array $filters):array{
        return $this->dao->list($filters);
    }
}   
