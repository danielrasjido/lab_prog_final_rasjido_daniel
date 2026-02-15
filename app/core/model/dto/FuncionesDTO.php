<?php

namespace app\core\model\dto;
use app\core\model\dto\base\InterfaceDto;
use DateTime;

final class FuncionesDTO implements InterfaceDto{
    private $idFuncion, $idPelicula, $idProgramacion, $idSala, $precio;
    private DateTime $fecha, $hora;


    public function __construct(array $data = []){
        if(!empty($data)){
            $this->setIdFuncion($data['idFuncion'] ?? 0);
            $this->setIdPelicula($data['idPelicula'] ?? 0);
            $this->setIdProgramacion($data['idProgramacion'] ?? 0);
            $this->setIdSala($data['idSala'] ?? 0);
            $this->setPrecio($data['precio'] ?? 0.00);
            $this->setFecha(new DateTime($data['fecha'] ?? 'now'));
            $this->setHora(new DateTime($data['hora'] ?? 'now'));
        }
    }

    // GETTERS

    public function getIdFuncion(): int
    {
        return $this->idFuncion;
    }

    public function getIdPelicula(): int
    {
        return $this->idPelicula;
    }

    public function getIdProgramacion(): int
    {
        return $this->idProgramacion;
    }

    public function getIdSala(): int
    {
        return $this->idSala;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getFecha(): DateTime
    {
        return $this->fecha;
    }

    public function getHora(): DateTime
    {
        return $this->hora;
    }

    // SETTERS

    public function setIdFuncion(int $idFuncion): void
    {
        $this->idFuncion = $idFuncion;
    }

    public function setIdPelicula(int $idPelicula): void
    {
        $this->idPelicula = $idPelicula;
    }

    public function setIdProgramacion(int $idProgramacion): void
    {
        $this->idProgramacion = $idProgramacion;
    }

    public function setIdSala(int $idSala): void
    {
        $this->idSala = $idSala;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    public function setFecha(DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function setHora(DateTime $hora): void
    {
        $this->hora = $hora;
    }

    // SERIALIZACION

    public function toArray(): array
    {
        return [
            'idFuncion' => $this->idFuncion,
            'idPelicula' => $this->idPelicula,
            'idProgramacion' => $this->idProgramacion,
            'idSala' => $this->idSala,
            'precio' => $this->precio,
            'fecha' => $this->fecha->format('Y-m-d'),
            'hora' => $this->hora->format('H:i:s'),
        ];
    }   

}