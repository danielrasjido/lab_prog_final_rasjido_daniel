<?php

namespace app\core\service;

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\ProgramacionDAO;
use app\core\model\dto\ProgramacionDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;
use Exception;


final class ProgramacionService implements InterfaceService{

    public const ESTADO_CANCELADA = 1;
    public const ESTADO_VIGENTE = 2;
    public const ESTADO_PROGRAMADA = 3;

    private ProgramacionDAO $dao;

    public function __construct()
    {
        $this->dao = new ProgramacionDAO(Connection::get());
    }

    public function load(int $id):InterfaceDto{

        $data = $this->dao->load($id);

        if($data === false){
            throw new \Exception("Programación no encontrada.");
        }

        return new ProgramacionDTO($data);
    }

    public function save(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $data['idEstadoProgramacion'] = $this->normalizarEstadoProgramacion(
            $data['idEstadoProgramacion'] ?? self::ESTADO_PROGRAMADA
        );

        $this->dao->save($data);
    }

    public function update(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $data['idEstadoProgramacion'] = $this->normalizarEstadoProgramacion(
            $data['idEstadoProgramacion'] ?? self::ESTADO_PROGRAMADA
        );

        $this->dao->update($data);
    }

    public function delete(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $id = $data['idProgramacion'];
        $this->dao->delete($id);
    }
    
    public function list(array $filters):array{
        return $this->dao->list($filters);
    }

    private function normalizarEstadoProgramacion(int $idEstadoProgramacion): int
    {
        $estadosValidos = [
            self::ESTADO_CANCELADA,
            self::ESTADO_VIGENTE,
            self::ESTADO_PROGRAMADA
        ];

        if (!in_array($idEstadoProgramacion, $estadosValidos, true)) {
            return self::ESTADO_PROGRAMADA;
        }

        return $idEstadoProgramacion;
    }
}