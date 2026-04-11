<?php

namespace app\core\service;

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\FuncionesDAO;
use app\core\model\dto\FuncionesDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\model\dto\SalasDTO;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;
use Exception;

final class FuncionesService implements InterfaceService{
    private FuncionesDAO $dao;

    public function __construct()
    {
        $this->dao = new FuncionesDAO(Connection::get());
    }

    public function load(int $id):InterfaceDto{

        $data = $this->dao->load($id);

        if($data === false){
            throw new \Exception("Función no encontrada.");
        }

        return new FuncionesDTO($data);
    }

    public function save(InterfaceDto $dto):void{
        $this->dao->save($dto->toArray());
    }

    public function update(InterfaceDto $dto):void{
        $this->dao->update($dto->toArray());
    }

    public function delete(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $id = $data['idFuncion'];
        $this->dao->delete($id);
    }
    
    public function list(array $filters):array{
        return $this->dao->list($filters);
    }

    //validamos que la sala seleccionada tenga estado = 1
    public function validarSalaHabilitada(int $idSala): void{
        $salaService = new SalasService();
        $salaDTO = $salaService->load($idSala);
        if($salaDTO->getEstado() != 1){
            throw new \Exception("La sala seleccionada no está habilitada.");
        }
    }


}