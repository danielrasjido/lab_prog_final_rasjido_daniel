<?php

namespace app\core\model\dao\base;

class BaseDAO{
    protected $connection;
    protected $table;

    public function __construct(?\PDO $connection, string $table){
        $this->connection = $connection;
        $this->table = $table;
    }

    //METODOS PUBLICOS

    public function foundRows():int{
        $stmt = $this->connection->query("SELECT FOUND_ROWS();");
        $data = $stmt->fetch(\PDO::FETCH_NUM);
        $stmt->closeCursor();
        return (int)$data[0];
    }

    public function countRows():int{
        $stmt = $this->connection->query("SELECT COUNT(*) FROM " . $this->table);
        $data = $stmt->fetch(\PDO::FETCH_NUM);
        $stmt->closeCursor();
        return (int)$data[0];
    }

    public function getLastInsertId():int{
        $id = $this->connection->lastInsertId();
        return is_numeric($id) ? (int) $id : 0;
    }
    
}