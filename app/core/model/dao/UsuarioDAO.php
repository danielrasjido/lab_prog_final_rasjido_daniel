<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
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