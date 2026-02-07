<?php

require_once __DIR__ . '/../vendor/autoload.php';
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;
use app\libs\database\Connection;
use app\core\service\UsuarioService;

echo "===== TEST UsuarioService =====\n";
$service = new UsuarioService();
$usuario = $service->load(1);

echo print_r($usuario);

$d1 = [
    "idPerfil"  => 3,
    "apellido"  => "Gomez",
    "nombre"    => "David",
    "cuenta"    => "davo.xeneize",
    "password"  => "12345678",
    "correo"    => "davo@gmail.com",
    "resetPassword" => 0,
    "estado"    => 1
];

$u1 = new UsuarioDTO($d1);

$service->save($u1);

echo "\n===== FIN TEST UsuarioService =====\n";
