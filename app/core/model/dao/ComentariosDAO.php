<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class ComentariosDAO extends BaseDAO{

    public function __construct(?PDO $connection)
    {
        parent::__construct($connection, 'comentarios');
    }

    public function load(int $id): array|false
    {
        $arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idComentario = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];

        return $arreglo;
    }

    public function save(array $data): void
    {
        //aca no tocamos el id, de eso se encarga mysql
        $sql = "INSERT INTO {$this->table} (
            idUsuario,
            idPelicula,
            comentario,
            fechaHora
        ) VALUES (
            :idUsuario,
            :idPelicula,
            :comentario,
            :fechaHora
        )";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ":idUsuario" => $data["idUsuario"],
            ":idPelicula" => $data["idPelicula"],
            ":comentario" => $data["comentario"],
            ":fechaHora" => $data["fechaHora"]
        ]);
    }

    public function update(array $data): void
    {
        $sql = "UPDATE {$this->table} SET 
            idUsuario = :idUsuario,
            idPelicula = :idPelicula,
            comentario = :comentario,
            fechaHora = :fechaHora
        WHERE idComentario = :idComentario";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ":idComentario" => $data["idComentario"],
            ":idUsuario" => $data["idUsuario"],
            ":idPelicula" => $data["idPelicula"],
            ":comentario" => $data["comentario"],
            ":fechaHora" => $data["fechaHora"]
        ]);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM {$this->table} WHERE idComentario = :idComentario";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([":idComentario" => $id]);
    }


    //CHEQUEAR MÁS ADELANTE
    public function list(array $filters): array
    {
        throw new Exception("Method not implemented");
    }

    public function suggestive(array $filters): array
    {
        throw new Exception("Method not implemented");
    }

}