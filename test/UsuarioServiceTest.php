<?php

require_once __DIR__ . '/../vendor/autoload.php';
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;
use app\libs\database\Connection;
use app\core\service\UsuarioService;

echo "===== TEST UsuarioService =====\n";
$service = new UsuarioService();
$usuario = $service->load(1);

$d1 = [
    "idPerfil"  => 3,
    "apellido"  => "Camila",
    "nombre"    => "Aballay",
    "cuenta"    => "camilita.bonita",
    "estado"    => 1,
    "password"  => "12345678",
    "correo"    => "cami_uwu@gmail.com",
    "resetPassword" => 0,
];

$u1 = new UsuarioDTO($d1);

//$service->save($u1);

//load, save, delete, UPDATE ya andan

// $service->delete($service->load(7));
// $service->delete($service->load(8));
// $service->delete($service->load(9));

// $u2 = new UsuarioDTO($service->load(10)->toArray());
// $u2->setCuenta('pinkipai');
// $service->update($u2);

echo print_r($service->list(['apellido' => 'ez']));

echo "\n===== FIN TEST UsuarioService =====\n";
