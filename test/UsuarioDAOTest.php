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

    echo "Intentando insertar usuario...\n";

    echo $data;

    $dao->save($data);

    echo "Usuario insertado correctamente\n";

    
    echo $usuario = $dao->load(1);

} catch (Exception $e) {
    echo "✖ Error al insertar usuario\n";
    echo "Mensaje: " . $e->getMessage() . "\n";
}

echo "\n=== FIN TEST ===";
