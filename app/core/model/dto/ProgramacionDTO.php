<?php

namespace app\core\model\dto;
use app\core\model\dto\base\InterfaceDto;
use DateTime;

final class ProgramacionDTO implements InterfaceDto{
    
    private $idProgramacion;
    private DateTime $fechaInicio, $fechaFin;
    
    public function __construct(array $data = []){
        if(!empty($data)){
            $this->setIdProgramacion($data['idProgramacion'] ?? 0);
            $this->setFechaInicio(new DateTime($data['fechaInicio'] ?? 'now'));
            $this->setFechaFin(new DateTime($data['fechaFin'] ?? 'now'));
        }
    }

    //getters
    
    public function getIdProgramacion(): int
    {
        return $this->idProgramacion;
    }

    public function getFechaInicio(): DateTime
    {
        return $this->fechaInicio;
    }

    public function getFechaFin(): DateTime
    {
        return $this->fechaFin;
    }

    //setters
    public function setIdProgramacion(int $idProgramacion): void{
        $this->idProgramacion = $idProgramacion;
    }

    public function setFechaInicio(DateTime $fechaInicio): void
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaFin(DateTime $fechaFin): void
    {
        $this->fechaFin = $fechaFin;
    }


    //serializacion

    public function toArray(): array
    {
        return [
            'idProgramacion' => $this->getIdProgramacion(),
            'fechaInicio' => $this->getFechaInicio()->format('Y-m-d H:i:s'),
            'fechaFin' => $this->getFechaFin()->format('Y-m-d H:i:s')
        ];
    }

}