<?php

//idsala capacidad estado

namespace app\core\model\dto;
use app\core\model\dto\base\InterfaceDto;

final class SalasDTO implements InterfaceDto{
    private $idSala, $capacidad, $estado;

    public function __construct(array $data = []){
    if(!empty($data)){
        $this->setIdSala($data['idSala'] ?? 0);
        $this->setCapacidad($data['capacidad'] ?? 0);
        $this->setEstado($data['estado'] ?? 1);
    }
}

    // GETTERS

    public function getIdSala():int{
        return $this->idSala;
    }

    public function getCapacidad(): int{
        return $this->capacidad;
    }

    public function getEstado(): int
    {
        return $this->estado;
    }

    // SETTERS

    public function setIdSala(int $idSala): void
    {
        $this->idSala = $idSala;
    }

    public function setCapacidad(int $capacidad): void
    {
        $this->capacidad = $capacidad;
    }

    public function setEstado(int $estado): void
    {
        $this->estado = $estado;
    }

    public function toArray(): array
    {
        return [
            'idSala' => $this->getIdSala(),
            'capacidad' => $this->getCapacidad(),
            'estado' => $this->getEstado()
        ];
    }

}