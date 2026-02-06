<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class PeliculasDAO extends BaseDAO{

    protected $connection;
    protected $table;

    public function __construct(?\PDO $connection, string $table){
        $this->connection = $connection;
        $this->table = $table;
    }
	
	public function load(int $id): array{
		$arreglo = [];

        $consulta = "SELECT * FROM {$this->table} WHERE idUsuario = :id";
        $stmt = $this->connection->prepare($consulta);
        $stmt->execute([":id" => $id]);

        $arreglo = $stmt->fetch(PDO::FETCH_ASSOC);


        return $arreglo;
	}
	

    public function save(array $data):void
    {

    }
  
    public function update(array $data):void
    {

    }
   
    public function delete(int $id):void
    {
        $sql = "DELETE FROM {$this->table} WHERE idPelicula = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(["id" => $id]);
    }

    public function list(array $filters):array
    {
        return [];
    }

    public function suggestive(array $filters): array
    {
        throw new \Exception('Not implemented');
    }
   
}