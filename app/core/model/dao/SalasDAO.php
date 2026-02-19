<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class SalasDAO extends BaseDAO {

    public function __construct(?PDO $connection)
    {
        parent::__construct($connection, 'salas');
    }

    /**
     * Carga una sala de la base de datos.
     * @param id Id de la sala que se quiere mostrar.
     */
    public function load(int $id):array|false
    {

        $arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idSala = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
        return $arreglo ?: false;
    }

    /**
     * Crea una sala nueva.
     * @param data Array con todos los campos de la tabla de salas.
     */
    public function save(array $data):void
    {
        $sql = "INSERT INTO {$this->table} (
            capacidad,
            estado
        ) VALUES (
            :capacidad,
            :estado
        )";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "capacidad" => $data["capacidad"],
            "estado" => $data["estado"]
        ]);
    }

    /**
     * Actualiza una sala existente.
     * @param id Id de la sala que se quiere actualizar.
     * @param data Array con los campos a actualizar de la tabla de salas.
     */

    public function update(array $data):void
    {
        $sql = "UPDATE {$this->table} SET
        capacidad = :capacidad,
        estado = :estado
        WHERE idSala = :idSala
        ";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "idSala"        => $data["idSala"],
            "capacidad"     => $data["capacidad"],
            "estado"        => $data["estado"]
        ]);

    }

    /**
     * Elimina una sala de la base de datos.
     * @param id Id de la sala que se quiere eliminar.
     */

    public function delete(int $id):void
    {
        $sql = "DELETE FROM {$this->table} WHERE idSala = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => $id]);
    }

    public function list(Array $filters):array
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";

        if(isset($filters["estado"])){
            $sql .= " AND estado = :estado";
        }

        $stmt = $this->connection->prepare($sql);

        if(isset($filters["estado"])){
            $stmt->bindValue(":estado", $filters["estado"], PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function suggestive(array $filters): array
    {
        throw new \Exception('Not implemented');
    }

}