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

    public function load(int $id):array{

        $arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idUsuario = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC);


        return $arreglo;
    }

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
            "idPerfil" => $data["idPerfil"],
            "apellido" => $data["apellido"],
            "nombre" => $data["nombre"],
            "cuenta" => $data["cuenta"],  
            "estado" => $data["estado"],
            "password" => $password,
            "correo" => $data["correo"],
            "resetPassword" => $data["resetPassword"]
        ]);

    }
    
    //necesita id
    public function update(array $data):void{

    }

    public function delete(int $id):void{

    }

    public function list(array $filters):array{
        return [];
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