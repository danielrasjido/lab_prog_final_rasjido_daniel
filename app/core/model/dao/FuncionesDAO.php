<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class FuncionesDAO extends BaseDAO implements InterfaceDAO
{

    public function __construct(?PDO $connection)
    {
        parent::__construct($connection, 'funciones');
        $this->asegurarColumnaEstado();
    }

    private function asegurarColumnaEstado(): void
    {
        $stmt = $this->connection->prepare("SHOW COLUMNS FROM {$this->table} LIKE 'estado'");
        $stmt->execute();
        $existe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existe) {
            return;
        }

        $this->connection->exec("ALTER TABLE {$this->table} ADD COLUMN estado TINYINT(1) NOT NULL DEFAULT 1");
    }

    /**
     * Carga una función de la base de datos.
     * @param id Id de la función que se quiere mostrar.
     */
    public function load(int $id): array|false
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
    public function save(array $data): void
    {
        //Insertar la función nueva en la db, de idFuncion se hace cargo sql
        $sql = "INSERT INTO {$this->table} (
            idPelicula,
            idProgramacion,
            idSala,
            precio,
            estado,
            fecha,
            hora
        ) VALUES (
            :idPelicula,
            :idProgramacion,
            :idSala,
            :precio,
            :estado,
            :fecha,
            :hora
        )";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "idPelicula" => $data["idPelicula"],
            "idProgramacion" => $data["idProgramacion"],
            "idSala" => $data["idSala"],
            "precio" => $data["precio"],
            "estado" => (int)($data["estado"] ?? 1),
            "fecha" => $data["fecha"],
            "hora" => $data["hora"]
        ]);
    }

    /**
     * Edita una función existente.
     * @param data Array con todos los campos de la tabla de funciones. 
     */
    public function update(array $data): void
    {
        $sql = "UPDATE {$this->table} SET
            idPelicula = :idPelicula,
            idProgramacion = :idProgramacion,
            idSala = :idSala,
            precio = :precio,
            estado = :estado,
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
            "estado" => (int)($data["estado"] ?? 1),
            "fecha" => $data["fecha"],
            "hora" => $data["hora"]
        ]);
    }

    public function cancelar(int $id): void
    {
        $sql = "UPDATE {$this->table} SET estado = 0 WHERE idFuncion = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => (int)$id]);
    }

    public function habilitar(int $id): void
    {
        $sql = "UPDATE {$this->table} SET estado = 1 WHERE idFuncion = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => (int)$id]);
    }

    public function cancelarPorPelicula(int $idPelicula): void
    {
        $sql = "UPDATE {$this->table} SET estado = 0 WHERE idPelicula = :idPelicula";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["idPelicula" => (int)$idPelicula]);
    }

    /**
     * Elimina una función de la base de datos.
     * @param id Id de la función que se quiere eliminar.
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM {$this->table} WHERE idFuncion = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => (int)$id]);
    }

    /**
     * Lista las funciones de la base de datos.
     * @param filters Array con los filtros para la consulta.
     *  
     * Si el array de filtros está vacío, se listan todas las funciones. Si no, se listan las funciones que cumplen con los filtros.
     */
    public function list(array $filters = []): array
    {
        $sql = "SELECT
            f.idFuncion,
            f.idPelicula,
            f.idProgramacion,
            f.idSala,
            f.precio,
            f.estado,
            f.fecha,
            f.hora,
            p.nombre AS nombrePelicula
        FROM {$this->table} f
        INNER JOIN peliculas p ON p.idPelicula = f.idPelicula";
        $conditions = [];
        $params = [];
        $columnMap = [
            'idFuncion' => 'f.idFuncion',
            'idPelicula' => 'f.idPelicula',
            'idProgramacion' => 'f.idProgramacion',
            'idSala' => 'f.idSala',
            'precio' => 'f.precio',
            'estado' => 'f.estado',
            'fecha' => 'f.fecha',
            'hora' => 'f.hora'
        ];

        if (!empty($filters)) {
            foreach ($filters as $key => $value) {
                if (!array_key_exists($key, $columnMap)) {
                    continue;
                }

                $conditions[] = "{$columnMap[$key]} = :$key";
                $params[":$key"] = $value;
            }

            if (!empty($conditions)) {
                $sql .= " WHERE " . implode(" AND ", $conditions);
            }
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
