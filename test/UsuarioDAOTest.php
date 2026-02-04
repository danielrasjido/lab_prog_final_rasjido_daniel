<?php
require_once __DIR__ . '/../vendor/autoload.php';
use app\core\model\dao\UsuarioDAO;
use app\libs\database\Connection;

echo "<pre>";

echo "=== TEST UsuarioDAO::save() ===\n\n";

try {
    $dao = new UsuarioDAO(Connection::get());

    $data = [
        "idPerfil" => 2,
        "apellido" => "Perez",
        "nombre" => "Juan",
        "cuenta" => "juan.perez",
        "estado" => 1,
        "password" => "123456",
        "correo" => "juan.perez@test.com",
        "resetPassword" => 0
    ];

    echo print_r($data);

    $data2 = [
        "idUsuario" => 5,
        "idPerfil" => 2,
        "apellido" => "Perez Editado",
        "nombre" => "Juan Editado",
        "cuenta" => "juan.perezzzzz",
        "estado" => 0,
        "password" => "123456",
        "correo" => "juan.perezzzzz@test.com",
        "resetPassword" => 0
    ];

    $dao->update($data2);

    //$dao->delete(5);

    $data3 = [
        "idPerfil" => 2,
        "apellido" => "Perez",
        "nombre" => "Tomás",
        "cuenta" => "tommy.perez",
        "estado" => 1,
        "password" => "123456",
        "correo" => "tomasito.perez@test.com",
        "resetPassword" => 0
    ];

    //$dao->save($data3);

    echo print_r($dao->list(["apellido" => "Perez"]));


} catch (Exception $e) {
    echo "Error al insertar usuario\n";
    echo "Mensaje: " . $e->getMessage() . "\n";
}

echo "\n=== FIN TEST ===";
