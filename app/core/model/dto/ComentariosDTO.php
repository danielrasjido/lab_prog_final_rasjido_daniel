<?php

namespace app\core\model\dto;
use app\core\model\dto\base\InterfaceDto;
use DateTime;

final class ComentariosDTO implements InterfaceDto{

    private $idComentario, $idUsuario, $idPelicula, $comentario;
    private DateTime $fechaHora;

    public function __construct(array $data = []){
        if(!empty($data)){
            $this->setIdComentario($data['idComentario'] ?? 0);
            $this->setIdUsuario($data['idUsuario'] ?? 0);
            $this->setIdPelicula($data['idPelicula'] ?? 0);
            $this->setComentario($data['comentario'] ?? '');
            $this->setFechaHora(new DateTime($data['fechaHora'] ?? 'now'));
        }
    }

    // GETTERS

    public function getIdComentario(){
        return $this->idComentario;
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getIdPelicula(){
        return $this->idPelicula;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function getFechaHora():DateTime{
        return $this->fechaHora;
    }

    // SETTERS

    public function setIdComentario($idComentario){
        $this->idComentario = $idComentario;
    }

    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function setIdPelicula($idPelicula){
        $this->idPelicula = $idPelicula;
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
    }

    public function setFechaHora(DateTime $fechaHora){
        $this->fechaHora = $fechaHora;
    }

    // SERIALIZACIÓN

    public function toArray():array{
        return [
            'idComentario' => $this->idComentario,
            'idUsuario' => $this->idUsuario,
            'idPelicula' => $this->idPelicula,
            'comentario' => $this->comentario,
            'fechaHora' => $this->fechaHora->format('Y-m-d H:i:s')
        ];
    }
}