<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class UsuarioDAO extends BaseDAO implements InterfaceDAO{

    public function __construct(?PDO $connection)
    {
        return parent::__construct($connection, 'usuarios');
    }

    /**
     * Carga un usuario de la base de datos.
     * @param id Id del usuario que se quiere mostrar.
     */
    public function load(int $id):array{

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
    public function save(array $data):void{
     
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
    public function update(array $data):void{

        $sql = 
        "UPDATE {$this->table} SET
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
    public function delete(int $id):void{
        $sql = "DELETE * FROM {$this->table} WHERE idUsuario = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id => $id"]);
    }

    /**
     * Lista usuarios en base a un filtro.
     * @param filters array con una o más claves para filtrar usuarios.
     */
    public function list(array $filters):array{
        //filtrar por nombre, apellido, tipo de cuenta, correo y estado.
        $resultado = [];
        $parametros = [];

        $sql = "SELECT * FROM {$this->table} WHERE 1=1";

        if(!empty($filters["nombre"])){
            $sql .= " AND (nombre LIKE :nombre)";
            $parametros["nombre"] = "%" . $filters["nombre"] . "%";
        }

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($parametros);
        $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function suggestive(array $filters):array{
        return [];
    }

    public function foundRows():int{
        return 0;
    }

    public function countRows():int{
        return 0;
    }

    public function getLastInsertId():int{
        return 0;
    }

}