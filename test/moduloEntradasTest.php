<?php

declare(strict_types=1);

use app\core\model\dto\EntradasDTO;
use app\core\service\EntradasService;

require_once __DIR__ . '/../app/config/DBConfig.php';
require_once __DIR__ . '/../vendor/autoload.php';

function assertTrue(bool $condition, string $message): void
{
	if ($condition) {
		echo "[PASS] {$message}\n";
		return;
	}

	echo "[FAIL] {$message}\n";
	exit(1);
}

try {
	$service = new EntradasService();

	$idFuncion = 1;
	$idUsuario = 3;
	$fechaCreacion = date('Y-m-d H:i:s');

	$entradaNueva = [
		'idFuncion' => $idFuncion,
		'idUsuario' => $idUsuario,
		'fechaHora' => $fechaCreacion,
		'anulada' => 0,
	];

	$dtoNueva = new EntradasDTO($entradaNueva);
	$service->save($dtoNueva);
	echo "[PASS] save ejecutado\n";

	$listaGuardada = $service->list([
		'idFuncion' => $idFuncion,
		'idUsuario' => $idUsuario,
		'fechaHora' => $fechaCreacion,
	]);

	assertTrue(!empty($listaGuardada), 'list encuentra la entrada recién creada');

	$entradaCreada = $listaGuardada[0];
	$idEntrada = (int)($entradaCreada['idEntrada'] ?? 0);
	assertTrue($idEntrada > 0, 'se obtuvo idEntrada válido');

	$cargada = $service->load($idEntrada);
	$cargadaArray = $cargada->toArray();
	assertTrue((int)$cargadaArray['idEntrada'] === $idEntrada, 'load devuelve la entrada correcta');

	$fechaActualizada = date('Y-m-d H:i:s', strtotime('+1 minute'));
	$dtoActualizar = new EntradasDTO([
		'idEntrada' => $idEntrada,
		'idFuncion' => $idFuncion,
		'idUsuario' => $idUsuario,
		'fechaHora' => $fechaActualizada,
		'anulada' => 1,
	]);

	$service->update($dtoActualizar);
	echo "[PASS] update ejecutado\n";

	$cargadaActualizada = $service->load($idEntrada)->toArray();
	assertTrue((int)$cargadaActualizada['anulada'] === 1, 'update persiste anulada = 1');
	assertTrue($cargadaActualizada['fechaHora'] === $fechaActualizada, 'update persiste la nueva fechaHora');

	$listaFiltrada = $service->list([
		'idUsuario' => $idUsuario,
		'anulada' => 1,
		'fechaHora' => $fechaActualizada,
	]);

	$idEncontrado = 0;
	foreach ($listaFiltrada as $item) {
		if ((int)($item['idEntrada'] ?? 0) === $idEntrada) {
			$idEncontrado = $idEntrada;
			break;
		}
	}

	assertTrue($idEncontrado === $idEntrada, 'list filtra correctamente por idUsuario/anulada/fechaHora');

	$service->delete($service->load($idEntrada));
	echo "[PASS] delete ejecutado\n";

	try {
		$service->load($idEntrada);
		assertTrue(false, 'load después de delete debería fallar');
	} catch (\Exception $ex) {
		echo "[PASS] delete eliminado correctamente (load falla como se esperaba)\n";
	}

	echo "\n✅ moduloEntradasTest finalizado correctamente.\n";
} catch (\Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
	exit(1);
}
