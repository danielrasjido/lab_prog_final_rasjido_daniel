<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class PeliculasDAO extends BaseDAO{

    protected $connection;
    protected $table;

    public function __construct(?\PDO $connection){
        $this->connection = $connection;
        $this->table = 'peliculas';
    }
	
	public function load(int $id): array|false
    {
		$arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idPelicula = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC);


        return $arreglo;
	}
	

    public function save(array $data):void
    {
        $sql = "INSERT INTO {$this->table}
        (nombre,
        tituloOriginal,
        duracion,
        fechaEstreno,
        disponibilidad,
        fechaIngreso,
        sitioWeb,
        sinopsis,
        imagenCartelera,
        actores,
        genero,
        pais,
        idiomas,
        calificacion) VALUES (
        :nombre,
        :tituloOriginal,
        :duracion,
        :fechaEstreno,
        :disponibilidad,
        :fechaIngreso,
        :sitioWeb,
        :sinopsis,
        :imagenCartelera,
        :actores,
        :genero,
        :pais,
        :idiomas,
        :calificacion)";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "nombre" => $data["nombre"],
            "tituloOriginal" => $data["tituloOriginal"],
            "duracion" => $data["duracion"],
            "fechaEstreno" => $data["fechaEstreno"],
            "disponibilidad" => $data["disponibilidad"],
            "fechaIngreso" => $data["fechaIngreso"],
            "sitioWeb" => $data["sitioWeb"],
            "sinopsis" => $data["sinopsis"],
            "imagenCartelera" => $data["imagenCartelera"],
            "actores" => $data["actores"],
            "genero" => $data["genero"],
            "pais" => $data["pais"],
            "idiomas" => $data["idiomas"],
            "calificacion" => $data["calificacion"]
        ]);
    }
  
    public function update(array $data):void
    {
        $sql = "UPDATE {$this->table} SET
        nombre          = :nombre,
        tituloOriginal  = :tituloOriginal,
        duracion        = :duracion,
        fechaEstreno    = :fechaEstreno,
        disponibilidad  = :disponibilidad,
        fechaIngreso    = :fechaIngreso,
        sitioWeb        = :sitioWeb,
        sinopsis        = :sinopsis,
        imagenCartelera = :imagenCartelera,
        actores         = :actores,
        genero          = :genero,
        pais            = :pais,
        idiomas         = :idiomas,
        calificacion    = :calificacion
        WHERE idPelicula = :idPelicula";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "idPelicula"        => $data["idPelicula"],
            "nombre"            => $data["nombre"],
            "tituloOriginal"    => $data["tituloOriginal"],
            "duracion"          => $data["duracion"],
            "fechaEstreno"      => $data["fechaEstreno"],
            "disponibilidad"    => $data["disponibilidad"],
            "fechaIngreso"      => $data["fechaIngreso"],
            "sitioWeb"          => $data["sitioWeb"],
            "sinopsis"          => $data["sinopsis"],
            "imagenCartelera"   => $data["imagenCartelera"],
            "actores"           => $data["actores"],
            "genero"            => $data["genero"],
            "pais"              => $data["pais"],
            "idiomas"           => $data["idiomas"],
            "calificacion"      => $data["calificacion"],
            "idPelicula"        => $data["idPelicula"]
        ]);
    }
   
    public function delete(int $id):void
    {
        $sql = "DELETE FROM {$this->table} WHERE idPelicula = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => $id]);
    }

    public function list(array $filters):array
    {
        //filtrar por nombre, titulo original, genero, pais, idioma, calificacion
        $resultado = [];
        $parametros = [];

        $sql = "SELECT * FROM {$this->table} WHERE 1=1";

        if(!empty($filters["nombre"])){
            $sql .= " AND nombre = :nombre";
            $parametros["nombre"] = $filters["nombre"];
        }

        if(!empty($filters["tituloOrignal"])){
            $sql .= " AND tituloOriginal = :tituloOriginal";
            $parametros["tituloOriginal"] = $filters["tituloOriginal"];
        }

        if(!empty($filters["genero"])){
            $sql .= " AND genero = :genero";
            $parametros["genero"] = $filters["genero"];
        }

        if(!empty($filters["pais"])){
            $sql .= " AND pais = :pais";
            $parametros["pais"] = $filters["pais"];
        }

        if(!empty($filters["idiomas"])){
            $sql .= " AND idiomas = :idiomas";
            $parametros["idiomas"] = $filters["idiomas"];
        }

        if(!empty($filters["calificacion"])){
            $sql .= " AND calificacion = :calificacion";
            $parametros["calificacion"] = $filters["calificacion"];
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($parametros);
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);


        return $resultado;
    }

    public function suggestive(array $filters): array
    {
        throw new \Exception('Not implemented');
    }
   
}