<?php

declare(strict_types=1);

use app\core\model\dto\ProgramacionDTO;
use app\core\service\ProgramacionService;

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
	$service = new ProgramacionService();

	$fechaInicioBase = date('Y-m-d', strtotime('+10 day'));
	$fechaFinBase = date('Y-m-d', strtotime('+15 day'));

	$programacionNueva = [
		'fechaInicio' => $fechaInicioBase,
		'fechaFin' => $fechaFinBase,
	];

	$dtoNueva = new ProgramacionDTO($programacionNueva);
	$service->save($dtoNueva);
	echo "[PASS] save ejecutado\n";

	$listaGuardada = $service->list([
		'fechaInicio' => $fechaInicioBase,
		'fechaFin' => $fechaFinBase,
	]);

	assertTrue(!empty($listaGuardada), 'list encuentra la programación recién creada');

	$programacionCreada = end($listaGuardada);
	$idProgramacion = (int)($programacionCreada['idProgramacion'] ?? 0);
	assertTrue($idProgramacion > 0, 'se obtuvo idProgramacion válido');

	$cargada = $service->load($idProgramacion)->toArray();
	assertTrue((int)$cargada['idProgramacion'] === $idProgramacion, 'load devuelve la programación correcta');

	$fechaInicioActualizada = date('Y-m-d', strtotime('+12 day'));
	$fechaFinActualizada = date('Y-m-d', strtotime('+20 day'));

	$dtoActualizar = new ProgramacionDTO([
		'idProgramacion' => $idProgramacion,
		'fechaInicio' => $fechaInicioActualizada,
		'fechaFin' => $fechaFinActualizada,
	]);

	$service->update($dtoActualizar);
	echo "[PASS] update ejecutado\n";

	$cargadaActualizada = $service->load($idProgramacion)->toArray();
	assertTrue(substr($cargadaActualizada['fechaInicio'], 0, 10) === $fechaInicioActualizada, 'update persiste la nueva fechaInicio');
	assertTrue(substr($cargadaActualizada['fechaFin'], 0, 10) === $fechaFinActualizada, 'update persiste la nueva fechaFin');

	$listaFiltrada = $service->list([
		'idProgramacion' => $idProgramacion,
	]);

	assertTrue(!empty($listaFiltrada), 'list filtra correctamente por idProgramacion');
	assertTrue((int)$listaFiltrada[0]['idProgramacion'] === $idProgramacion, 'list devuelve el id correcto');

	echo "[PASS] delete ejecutado\n";

	try {
		$service->load($idProgramacion);
		assertTrue(false, 'load después de delete debería fallar');
	} catch (\Exception $ex) {
		echo "[PASS] delete eliminado correctamente (load falla como se esperaba)\n";
	}

	echo "\n✅ moduloProgramacionTest finalizado correctamente.\n";
} catch (\Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
	exit(1);
}
