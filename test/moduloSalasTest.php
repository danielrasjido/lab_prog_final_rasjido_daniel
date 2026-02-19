<?php

declare(strict_types=1);

use app\core\model\dto\SalasDTO;
use app\core\service\SalasService;

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
	$service = new SalasService();

	$capacidadBase = 77;
	$estadoBase = 1;

	$salaNueva = [
		'capacidad' => $capacidadBase,
		'estado' => $estadoBase,
	];

	$dtoNueva = new SalasDTO($salaNueva);
	$service->save($dtoNueva);
	echo "[PASS] save ejecutado\n";

	$listaGuardada = $service->list(['estado' => $estadoBase]);
	assertTrue(!empty($listaGuardada), 'list devuelve resultados para estado = 1');

	$idSala = 0;
	foreach ($listaGuardada as $item) {
		$idActual = (int)($item['idSala'] ?? 0);
		if ($idActual > $idSala) {
			$idSala = $idActual;
		}
	}

	assertTrue($idSala > 0, 'se obtuvo idSala de la sala creada');

	$cargada = $service->load($idSala)->toArray();
	assertTrue((int)$cargada['idSala'] === $idSala, 'load devuelve la sala correcta');

	$capacidadActualizada = 99;
	$estadoActualizado = 0;

	$dtoActualizar = new SalasDTO([
		'idSala' => $idSala,
		'capacidad' => $capacidadActualizada,
		'estado' => $estadoActualizado,
	]);

	$service->update($dtoActualizar);
	echo "[PASS] update ejecutado\n";

	$cargadaActualizada = $service->load($idSala)->toArray();
	assertTrue((int)$cargadaActualizada['capacidad'] === $capacidadActualizada, 'update persiste la nueva capacidad');
	assertTrue((int)$cargadaActualizada['estado'] === $estadoActualizado, 'update persiste el nuevo estado');

	$listaFiltrada = $service->list(['estado' => $estadoActualizado]);
	$encontrada = false;
	foreach ($listaFiltrada as $item) {
		if ((int)($item['idSala'] ?? 0) === $idSala) {
			$encontrada = true;
			break;
		}
	}

	assertTrue($encontrada, 'list filtra correctamente por estado actualizado');

	$service->delete($service->load($idSala));
	echo "[PASS] delete ejecutado\n";

	try {
		$service->load($idSala);
		assertTrue(false, 'load después de delete debería fallar');
	} catch (\Exception $ex) {
		echo "[PASS] delete eliminado correctamente (load falla como se esperaba)\n";
	}

	echo "\n✅ moduloSalasTest finalizado correctamente.\n";
} catch (\Exception $e) {
	echo "Error: " . $e->getMessage() . "\n";
	exit(1);
}
