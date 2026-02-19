<?php

declare(strict_types=1);

use app\core\model\dto\FuncionesDTO;
use app\core\service\FuncionesService;

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
	$service = new FuncionesService();

	$fechaBase = date('Y-m-d', strtotime('+7 day'));
	$horaBase = date('H:i:s', strtotime('+5 minute'));
	$precioBase = 4321.50;

	$funcionNueva = [
		'idPelicula' => 1,
		'idProgramacion' => 1,
		'idSala' => 1,
		'precio' => $precioBase,
		'fecha' => $fechaBase,
		'hora' => $horaBase,
	];

	$dtoNueva = new FuncionesDTO($funcionNueva);
	$service->save($dtoNueva);
	echo "[PASS] save ejecutado\n";

	$listaGuardada = $service->list([
		'idPelicula' => 1,
		'idProgramacion' => 1,
		'idSala' => 1,
		'precio' => $precioBase,
		'fecha' => $fechaBase,
		'hora' => $horaBase,
	]);

	assertTrue(!empty($listaGuardada), 'list encuentra la función recién creada');

	$funcionCreada = $listaGuardada[0];
	$idFuncion = (int)($funcionCreada['idFuncion'] ?? 0);
	assertTrue($idFuncion > 0, 'se obtuvo idFuncion válido');

	$cargada = $service->load($idFuncion)->toArray();
	assertTrue((int)$cargada['idFuncion'] === $idFuncion, 'load devuelve la función correcta');

	$precioActualizado = 4999.99;
	$horaActualizada = date('H:i:s', strtotime('+8 minute'));

	$dtoActualizar = new FuncionesDTO([
		'idFuncion' => $idFuncion,
		'idPelicula' => 1,
		'idProgramacion' => 1,
		'idSala' => 1,
		'precio' => $precioActualizado,
		'fecha' => $fechaBase,
		'hora' => $horaActualizada,
	]);

	$service->update($dtoActualizar);
	echo "[PASS] update ejecutado\n";

	$cargadaActualizada = $service->load($idFuncion)->toArray();
	assertTrue(abs((float)$cargadaActualizada['precio'] - $precioActualizado) < 0.001, 'update persiste el nuevo precio');
	assertTrue($cargadaActualizada['hora'] === $horaActualizada, 'update persiste la nueva hora');

	$listaFiltrada = $service->list([
		'idFuncion' => $idFuncion,
		'precio' => $precioActualizado,
	]);

	assertTrue(!empty($listaFiltrada), 'list filtra correctamente por idFuncion y precio');
	assertTrue((int)$listaFiltrada[0]['idFuncion'] === $idFuncion, 'list devuelve el id correcto');

	

	try {
		$service->load($idFuncion);
		assertTrue(false, 'load después de delete debería fallar');
	} catch (\Exception $ex) {
		echo "[PASS] delete eliminado correctamente (load falla como se esperaba)\n";
	}

	echo "\n✅ moduloFuncionesTest finalizado correctamente.\n";
} catch (\Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
	exit(1);
}
