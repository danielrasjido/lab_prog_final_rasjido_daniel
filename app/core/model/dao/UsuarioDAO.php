<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class UsuarioDAO extends BaseDAO {

    public function __construct(?PDO $connection)
    {
        return parent::__construct($connection, 'usuarios');
    }

    /**
     * Carga un usuario de la base de datos.
     * @param id Id del usuario que se quiere mostrar.
     */
    public function load(int $id):array
    {

        $arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idUsuario = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC);


        return $arreglo;
    }

    /**
     * Crea un usuario nuevo.
     * @param data Array con todos los campos de la tabla de usuario. 
     */
    public function save(array $data):void
    {
     
        //validar que no exista otro usuario con la misma cuenta o correo
        $consulta = "SELECT COUNT(*) AS cantidad 
        FROM {$this->table} 
        WHERE correo = :correo or cuenta = :cuenta";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([
            "correo" => $data["correo"],
            "cuenta" => $data["cuenta"]
        ]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        if((Int)$resultado["cantidad"] > 0){
            throw new Exception("Ya existe un usuario con esa cuenta o correo");
        }

        //Insertar el usuario nuevo en la db, de idUsuario se hace cargo sql
        $sql = "INSERT INTO {$this->table} (
            idPerfil,
            apellido,
            nombre,
            cuenta,
            estado,
            password,
            correo,
            resetPassword
        ) VALUES(
            :idPerfil,
            :apellido,
            :nombre,
            :cuenta,
            :estado,
            :password,
            :correo,
            :resetPassword
        )";
        $stmt = $this->connection->prepare($sql);

        //hashear clave
        $password = password_hash($data["password"], PASSWORD_DEFAULT);

        $stmt->execute([
            "idPerfil"      => $data["idPerfil"],
            "apellido"      => $data["apellido"],
            "nombre"        => $data["nombre"],
            "cuenta"        => $data["cuenta"],  
            "estado"        => $data["estado"],
            "password"      => $password,
            "correo"        => $data["correo"],
            "resetPassword" => $data["resetPassword"]
        ]);

    }
    
    /**
     * Actualiza un usuario en función del ID.
     * @param data Array con los campos de la tabla usuario.
     */
    public function update(array $data):void
    {

        $sql = 
        "UPDATE {$this->table} SET
            idPerfil    = :idPerfil,
            apellido    = :apellido,
            nombre      = :nombre,
            cuenta      = :cuenta,
            estado      = :estado,
            password    = :password,
            correo      = :correo,
            resetPassword = :resetPassword
         WHERE idUsuario = :idUsuario   
        ";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
        "idPerfil"      => $data["idPerfil"],
        "apellido"      => $data["apellido"],
        "nombre"        => $data["nombre"],
        "cuenta"        => $data["cuenta"],
        "estado"        => $data["estado"],
        "password"      => $data["password"], 
        "correo"        => $data["correo"],
        "resetPassword" => $data["resetPassword"],
        "idUsuario"     => $data["idUsuario"]
        ]);

    }

    /**
     * Elimina un usuario de la base de datos en función del Id de usuario.
     * @param id Identificador de usuario.
     */
    public function delete(int $id):void
    {
        $sql = "DELETE FROM {$this->table} WHERE idUsuario = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => (Int)$id]);
    }

    /**
     * Obtiene una lista de usuarios aplicando filtros dinámicos.
     *
     * @param array filters Filtros posibles:
     *  - nombre (string)
     *  - apellido (string)
     *  - correo (string)
     *  - idPerfil (int)
     *  - estado (int|bool)
     *
     * @return array Lista de usuarios encontrados
     */
    public function list(array $filters):array
    {
        //filtrar por nombre, apellido, tipo de cuenta, correo y estado.
        $resultado = [];
        $parametros = [];

        $sql = "SELECT * FROM {$this->table} WHERE 1=1";

        if(!empty($filters["nombre"])){
            $sql .= " AND (nombre LIKE :nombre)";
            $parametros["nombre"] = "%" . $filters["nombre"] . "%";
        }

        if(!empty($filters["apellido"])){
            $sql .= " AND (apellido LIKE :apellido)";
            $parametros["apellido"] = "%" . $filters["apellido"] . "%";
        }

        if(isset($filters["idPerfil"])){
            $sql .= " AND idPerfil = :idPerfil";
            $parametros["idPerfil"] = (Int)$filters["idPerfil"];
        }

        if(!empty($filters["correo"])){
            $sql .= " AND (correo LIKE :correo)";
            $parametros["correo"] = "%" . $filters["correo"] . "%";
        }

        if(isset($filters["estado"])){
            $sql .= " AND estado = :estado";
            $parametros["estado"] = (Int)$filters["estado"];
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($parametros);
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function suggestive(array $filters): array
    {
        
        $sql = "SELECT idUsuario, nombre, apellido, correo FROM {$this->table} WHERE 1 = 1";

        $parametros = [];
        $resultado = [];

        if(!empty($filters['query'])){
            $sql .= " AND (
                nombre LIKE :q,
                OR apellido LIKE :q,
            )";

            $parametros['q'] = '%' . $filters['query'] . '%';
        }

        $sql .= " ORDER BY apellido, nombre LIMIT 10";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($parametros);
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $resultado;
    }

}