<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class FuncionesDAO extends BaseDAO implements InterfaceDAO {

    public function __construct(?PDO $connection)
    {
        return parent::__construct($connection, 'funciones');
    }

    /**
     * Carga una función de la base de datos.
     * @param id Id de la función que se quiere mostrar.
     */
    public function load(int $id):array|false
    {

        $arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idFuncion = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];

        return $arreglo ?: false;
    }

    /**
     * Crea una función nueva.
     * @param data Array con todos los campos de la tabla de funciones. 
     */
    public function save(array $data):void
    {
        //Insertar la función nueva en la db, de idFuncion se hace cargo sql
        $sql = "INSERT INTO {$this->table} (
            idPelicula,
            idProgramacion,
            idSala,
            precio,
            fecha,
            hora
        ) VALUES (
            :idPelicula,
            :idProgramacion,
            :idSala,
            :precio,
            :fecha,
            :hora
        )";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "idPelicula" => $data["idPelicula"],
            "idProgramacion" => $data["idProgramacion"],
            "idSala" => $data["idSala"],
            "precio" => $data["precio"],
            "fecha" => $data["fecha"],
            "hora" => $data["hora"]
        ]);
    }

        /**
        * Edita una función existente.
        * @param data Array con todos los campos de la tabla de funciones. 
        */
    public function update(array $data):void
    {
        $sql = "UPDATE {$this->table} SET
            idPelicula = :idPelicula,
            idProgramacion = :idProgramacion,
            idSala = :idSala,
            precio = :precio,
            fecha = :fecha,
            hora = :hora
        WHERE idFuncion = :idFuncion";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "idFuncion" => $data["idFuncion"],
            "idPelicula" => $data["idPelicula"],
            "idProgramacion" => $data["idProgramacion"],
            "idSala" => $data["idSala"],
            "precio" => $data["precio"],
            "fecha" => $data["fecha"],
            "hora" => $data["hora"]
        ]);
    }

    /**
     * Elimina una función de la base de datos.
     * @param id Id de la función que se quiere eliminar.
     */
    public function delete(int $id):void
    {
        $sql = "DELETE FROM {$this->table} WHERE idFuncion = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => (Int)$id]);
    }

    /**
     * Lista las funciones de la base de datos.
     * @param filters Array con los filtros para la consulta.
     *  
     * Si el array de filtros está vacío, se listan todas las funciones. Si no, se listan las funciones que cumplen con los filtros.
     */
    public function list(array $filters = []):array
    {
        $sql = "SELECT * FROM {$this->table}";
        $conditions = [];
        $params = [];

        if (!empty($filters)) {
            foreach ($filters as $key => $value) {
                $conditions[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // suggestive más adelante implementar
    public function suggestive(array $filters): array
    {
        throw new \Exception('Not implemented');
    }


}