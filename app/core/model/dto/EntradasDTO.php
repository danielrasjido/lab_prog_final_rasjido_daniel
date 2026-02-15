<?php

namespace app\core\model\dto;
use app\core\model\dto\base\InterfaceDto;

final class EntradasDTO implements InterfaceDto{
    private $idEntrada, $idFuncion, $idUsuario, $anulada;
    private $fechaHora;

    public function __construct(array $data = []){
        if(!empty($data)){
            $this->setIdEntrada($data['idEntrada'] ?? 0);
            $this->setIdFuncion($data['idFuncion'] ?? 0);
            $this->setIdUsuario($data['idUsuario'] ?? 0);
            $this->setAnulada($data['anulada'] ?? 0);
            $this->setFechaHora($data['fechaHora'] ?? '');
        }
    }

    // GETTERS

    public function getIdEntrada(): int
    {
        return $this->idEntrada;
    }

    public function getIdFuncion(): int
    {
        return $this->idFuncion;
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function getAnulada(): int
    {
        return $this->anulada;
    }

    public function getFechaHora(): string
    {
        return $this->fechaHora;
    }

    // Setters

    public function setIdEntrada(int $idEntrada): void
    {
        $this->idEntrada = $idEntrada;
    }

    public function setIdFuncion(int $idFuncion): void
    {
        $this->idFuncion = $idFuncion;
    }

    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function setAnulada(int $anulada): void
    {
        $this->anulada = $anulada;
    }

    public function setFechaHora(string $fechaHora): void
    {
        $this->fechaHora = $fechaHora;
    }

    // serializacion

    public function toArray(): array
    {
        return [
            'idEntrada'     => $this->idEntrada,
            'idFuncion'     => $this->idFuncion,
            'idUsuario'     => $this->idUsuario,
            'anulada'       => $this->anulada,
            'fechaHora'     => $this->fechaHora
        ];
    }

}