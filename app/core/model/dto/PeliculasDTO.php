<?php

namespace app\core\model\dto;
use app\core\model\dto\base\InterfaceDto;

final class PeliculasDTO implements InterfaceDto{

    private $idPelicula, $nombre, $tituloOriginal, $duracion, $fechaEstreno, $disponibilidad, 
    $fechaIngreso, $sitioWeb, $sinopsis, $imagenCartelera, $actores, $genero, $pais, $idiomas, $calificacion;

    public function __construct(array $data = []){
        if(!empty($data)){
            $this->setIdPelicula($data['idPelicula'] ?? 0);
            $this->setNombre($data['nombre'] ?? '');
            $this->setTituloOriginal($data['tituloOriginal'] ?? '');
            $this->setDuracion($data['duracion'] ?? 0);
            $this->setFechaEstreno($data['fechaEstreno'] ?? '');
            $this->setDisponibilidad($data['disponibilidad'] ?? 1);
            $this->setFechaIngreso($data['fechaIngreso'] ?? '');
            $this->setSitioWeb($data['sitioWeb'] ?? '');
            $this->setSinopsis($data['sinopsis'] ?? '');
            $this->setImagenCartelera($data['imagenCartelera'] ?? '');
            $this->setActores($data['actores'] ?? '');
            $this->setGenero($data['genero'] ?? '');
            $this->setPais($data['pais'] ?? '');
            $this->setIdiomas($data['idiomas'] ?? '');
            $this->setCalificacion($data['calificacion'] ?? 0);
        }
    }

    // GETTERS

    public function getIdPelicula(): int{
        return $this->idPelicula;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getTituloOriginal(): string{
        return $this->tituloOriginal;
    }

    public function getDuracion(): int{
        return $this->duracion;
    }

    public function getFechaEstreno(): string{
        return $this->fechaEstreno;
    }

    public function getDisponibilidad(): int{
        return $this->disponibilidad;
    }

    public function getFechaIngreso(): string{
        return $this->fechaIngreso;
    }

    public function getSitioWeb(): string{
        return $this->sitioWeb;
    }

    public function getSinopsis(): string{
        return $this->sinopsis;
    }

    public function getImagenCartelera(): string{
        return $this->imagenCartelera;
    }

    public function getActores(): string{
        return $this->actores;
    }

    public function getGenero(): string{
        return $this->genero;
    }

    public function getPais(): string{
        return $this->pais;
    }

    public function getIdiomas(): string{
        return $this->idiomas;
    }

    public function getCalificacion(): int{
        return $this->calificacion;
    }

    // SETTERS

    public function setIdPelicula(int $id): void{
        $this->idPelicula = ($id > 0) ? $id : 0;
    }


    public function setNombre(string $nombre): void{
        $this->nombre = trim($nombre);
    }

    public function setTituloOriginal(string $tituloOriginal): void{
        $this->tituloOriginal = trim($tituloOriginal);
    }

    public function setDuracion(int $duracion): void{
        $this->duracion = ($duracion > 0) ? $duracion : 0;
    }

    public function setFechaEstreno(string $fechaEstreno): void{
        $this->fechaEstreno = trim($fechaEstreno);
    }

    public function setDisponibilidad(int $disponibilidad): void{
        $this->disponibilidad = ($disponibilidad === 0) ? 0 : 1;
    }

    public function setFechaIngreso(string $fechaIngreso): void{
        $this->fechaIngreso = trim($fechaIngreso);
    }

    public function setSitioWeb(string $sitioWeb): void{
        $this->sitioWeb = trim($sitioWeb);
    }

    public function setSinopsis(string $sinopsis): void{
        $this->sinopsis = trim($sinopsis);
    }

    public function setImagenCartelera(string $imagenCartelera): void{
        $this->imagenCartelera = trim($imagenCartelera);
    }

    public function setActores(string $actores): void{
        $this->actores = trim($actores);
    }

    public function setGenero(string $genero): void{
        $this->genero = trim($genero);
    }

    public function setPais(string $pais): void{
        $this->pais = trim($pais);
    }

    public function setIdiomas(string $idiomas): void{
        $this->idiomas = trim($idiomas);
    }

    public function setCalificacion(String $calificacion): void{
        $this->calificacion = ($calificacion >= 0 && $calificacion <= 10) ? $calificacion : 0;
    }

    // SERIALIZACION
    


    public function toArray(): array
    {
        return [
            'idPelicula'      => $this->idPelicula,
            'nombre'          => $this->nombre,
            'tituloOriginal'  => $this->tituloOriginal,
            'duracion'        => $this->duracion,
            'fechaEstreno'    => $this->fechaEstreno,
            'disponibilidad'  => $this->disponibilidad,
            'fechaIngreso'    => $this->fechaIngreso,
            'sitioWeb'        => $this->sitioWeb,
            'sinopsis'        => $this->sinopsis,
            'imagenCartelera' => $this->imagenCartelera,
            'actores'         => $this->actores,
            'genero'          => $this->genero,
            'pais'            => $this->pais,
            'idiomas'        => $this->idiomas,
            'calificacion'    => $this->calificacion,
        ];
    }
}