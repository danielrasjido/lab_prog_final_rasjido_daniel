<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class EntradasDAO extends BaseDAO {

    public function __construct(?PDO $connection)
    {
        return parent::__construct($connection, 'entradas');
    }

    /**
     * Carga una entrada de la base de datos.
     * @param id Id de la entrada que se quiere mostrar.
     */
    public function load(int $id):array|false
    {

        $arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idEntrada = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
        return $arreglo ?: false;
    }

    /**
     * Crea una entrada nueva.
     * @param data Array con todos los campos de la tabla de entradas.
     */
    public function save(array $data):void
    {
        $sql = "INSERT INTO {$this->table} (
            idFuncion,
            idUsuario,
            fechaHora,
            anulada
        ) VALUES (
            :idFuncion,
            :idUsuario,
            :fechaHora,
            :anulada
        )";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "idFuncion" => $data["idFuncion"],
            "idUsuario" => $data["idUsuario"],
            "fechaHora" => $data["fechaHora"],
            "anulada" => $data["anulada"]
        ]);
    }

    /**
     * Actualiza una entrada en función del ID.
     * @param data Array con los campos de la tabla entradas.
     */
    public function update(array $data):void
    {
        $sql = "UPDATE {$this->table} SET
            idFuncion = :idFuncion,
            idUsuario = :idUsuario,
            fechaHora = :fechaHora,
            anulada = :anulada
        WHERE idEntrada = :idEntrada";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            "idEntrada" => $data["idEntrada"],
            "idFuncion" => $data["idFuncion"],
            "idUsuario" => $data["idUsuario"],
            "fechaHora" => $data["fechaHora"],
            "anulada" => $data["anulada"]
        ]);
    }

    /**
     * Elimina una entrada de la base de datos en función del ID.
     * @param id Identificador de entrada.
     */
    public function delete(int $id):void
    {
        $sql = "DELETE FROM {$this->table} WHERE idEntrada = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => (Int)$id]);
    }

    /**
     * Obtiene una lista de entradas aplicando filtros dinámicos.
     *
     * @param array filters Filtros posibles:
     *  - idFuncion (int)
     *  - idUsuario (int)
     *  - fechaHora (string)
     *  - anulada (int|bool)
     *
     * @return array Lista de entradas encontradas
     */
    public function list(array $filters):array
    {
        $resultado = [];
        $parametros = [];

        $sql = "SELECT * FROM {$this->table} WHERE 1=1";

        if(isset($filters["idFuncion"])){
            $sql .= " AND idFuncion = :idFuncion";
            $parametros["idFuncion"] = (Int)$filters["idFuncion"];
        }

        if(isset($filters["idUsuario"])){
            $sql .= " AND idUsuario = :idUsuario";
            $parametros["idUsuario"] = (Int)$filters["idUsuario"];
        }

        if(!empty($filters["fechaHora"])){
            $sql .= " AND fechaHora LIKE :fechaHora";
            $parametros["fechaHora"] = "%" . $filters["fechaHora"] . "%";
        }

        if(isset($filters["anulada"])){
            $sql .= " AND anulada = :anulada";
            $parametros["anulada"] = (Int)$filters["anulada"];
        }

        $sql .= " ORDER BY fechaHora DESC";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($parametros);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

    /**
     * Búsqueda sugerida de entradas.
     *
     * @param array filters Filtro opcional:
     *  - query (string): se busca por idEntrada, idFuncion, idUsuario o fechaHora
     */
    public function suggestive(array $filters): array
    {
        $sql = "SELECT idEntrada, idFuncion, idUsuario, fechaHora, anulada FROM {$this->table} WHERE 1 = 1";

        $parametros = [];
        $resultado = [];

        if(!empty($filters['query'])){
            $sql .= " AND (
                CAST(idEntrada AS CHAR) LIKE :q
                OR CAST(idFuncion AS CHAR) LIKE :q
                OR CAST(idUsuario AS CHAR) LIKE :q
                OR fechaHora LIKE :q
            )";

            $parametros['q'] = '%' . $filters['query'] . '%';
        }

        $sql .= " ORDER BY fechaHora DESC LIMIT 10";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($parametros);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

}

    