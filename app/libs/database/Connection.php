<?php

namespace app\libs\database;

require_once __DIR__ . '/../../config/dbConfig.php';

final class Connection{

    //static indica que la variable pertenece a la clase, no a un objeto
    private static ?\PDO $conn = null;

    private function __construct()
    {
     //nada
    }

    //static es para acceder a este método get sin instanciar la clase
    public static function get(): \PDO{

    //si no hay conexión, creala. Retorna la conexión
        if(self::$conn === null){
            self::$conn = new \PDO(
                DATABASE_DSN,
                "root",
                 "",
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
                ]
            );
        }

        return self::$conn;
    }
    

}