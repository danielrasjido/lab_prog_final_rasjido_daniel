<?php

namespace app\core\service;

use app\core\model\dto\ComentariosDTO;
use app\core\model\dto\EntradasDTO;
use app\core\model\dto\PeliculasDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\service\base\InterfaceService;

final class CatalogoService implements InterfaceService
{
	private PeliculasService $peliculasService;
	private FuncionesService $funcionesService;
	private ComentariosService $comentariosService;
	private EntradasService $entradasService;
	private SalasService $salasService;
	private ProgramacionService $programacionService;

	public function __construct()
	{
		$this->peliculasService = new PeliculasService();
		$this->funcionesService = new FuncionesService();
		$this->comentariosService = new ComentariosService();
		$this->entradasService = new EntradasService();
		$this->salasService = new SalasService();
		$this->programacionService = new ProgramacionService();
	}

	public function load(int $id): InterfaceDto
	{
		/** @var PeliculasDTO $pelicula */
		$pelicula = $this->peliculasService->load($id);

		if ($pelicula->getDisponibilidad() !== 1) {
			throw new \Exception("La película seleccionada no está disponible en catálogo.");
		}

		return $pelicula;
	}

	public function save(InterfaceDto $dto): void
	{
		throw new \Exception("La operación save no está disponible en catálogo.");
	}

	public function update(InterfaceDto $dto): void
	{
		throw new \Exception("La operación update no está disponible en catálogo.");
	}

	public function delete(InterfaceDto $dto): void
	{
		throw new \Exception("La operación delete no está disponible en catálogo.");
	}

    /**
     * Devuelve un listado de películas disponibles en el catálogo, aplicando los filtros indicados.
     */
	public function list(array $filters): array
	{
		$peliculas = $this->peliculasService->list($filters);
		$funcionesDisponibles = $this->obtenerFuncionesCatalogo();
		$funcionesPorPelicula = [];

		foreach ($funcionesDisponibles as $funcion) {
			$idPelicula = (int)$funcion['idPelicula'];
			$funcionesPorPelicula[$idPelicula] = ($funcionesPorPelicula[$idPelicula] ?? 0) + 1;
		}

		$resultado = [];

		foreach ($peliculas as $pelicula) {
			$idPelicula = (int)($pelicula['idPelicula'] ?? 0);

			if ((int)($pelicula['disponibilidad'] ?? 0) !== 1) {
				continue;
			}

			if (!isset($funcionesPorPelicula[$idPelicula])) {
				continue;
			}

			$pelicula['funcionesDisponibles'] = $funcionesPorPelicula[$idPelicula];
			$resultado[] = $pelicula;
		}

		return $resultado;
	}

	public function detalle(int $idPelicula): array
	{
		$pelicula = $this->load($idPelicula)->toArray();

		return [
			'pelicula' => $pelicula,
			'funciones' => $this->obtenerFuncionesCatalogo($idPelicula),
			'comentarios' => $this->obtenerComentariosPelicula($idPelicula)
		];
	}

	public function comentar(array $data, int $idUsuario): void
	{
		$idPelicula = (int)($data['idPelicula'] ?? 0);
		$comentario = trim((string)($data['comentario'] ?? ''));

		if ($idPelicula <= 0) {
			throw new \Exception("Debe indicar una película válida para comentar.");
		}

		if ($comentario === '') {
			throw new \Exception("Debe escribir un comentario.");
		}

		$this->load($idPelicula);

		$dto = new ComentariosDTO([
			'idComentario' => 0,
			'idUsuario' => $idUsuario,
			'idPelicula' => $idPelicula,
			'comentario' => $comentario,
			'fechaHora' => date('Y-m-d H:i:s')
		]);

		$this->comentariosService->save($dto);
	}

	public function comprar(array $data, int $idUsuario): void
	{
		$idFuncion = (int)($data['idFuncion'] ?? 0);

		if ($idFuncion <= 0) {
			throw new \Exception("Debe seleccionar una función válida para comprar.");
		}

		$funcion = $this->funcionesService->load($idFuncion)->toArray();

		if (!$this->esFuncionDisponibleEnCatalogo($funcion)) {
			throw new \Exception("La función seleccionada no está disponible para la compra.");
		}

		$this->validarCapacidadDisponible($funcion);

		$dto = new EntradasDTO([
			'idEntrada' => 0,
			'idFuncion' => $idFuncion,
			'idUsuario' => $idUsuario,
			'anulada' => 0,
			'fechaHora' => date('Y-m-d H:i:s')
		]);

		$this->entradasService->save($dto);
	}

	public function misEntradas(int $idUsuario): array
	{
		$entradas = $this->entradasService->list([
			'idUsuario' => $idUsuario,
			'anulada' => 0
		]);

		foreach ($entradas as &$entrada) {
			$funcion = $this->funcionesService->load((int)$entrada['idFuncion'])->toArray();
			$pelicula = $this->peliculasService->load((int)$funcion['idPelicula'])->toArray();

			$entrada['nombrePelicula'] = $pelicula['nombre'];
			$entrada['fecha'] = $funcion['fecha'];
			$entrada['hora'] = $funcion['hora'];
			$entrada['precio'] = $funcion['precio'];
		}

		unset($entrada);

		return $entradas;
	}

	private function obtenerComentariosPelicula(int $idPelicula): array
	{
		$comentarios = $this->comentariosService->list([]);

		$comentarios = array_values(array_filter(
			$comentarios,
			fn(array $comentario): bool => (int)($comentario['idPelicula'] ?? 0) === $idPelicula
		));

		usort($comentarios, function (array $a, array $b): int {
			return strcmp((string)$b['fechaHora'], (string)$a['fechaHora']);
		});

		return $comentarios;
	}

	private function obtenerFuncionesCatalogo(?int $idPelicula = null): array
	{
		$filters = [];

		if ($idPelicula !== null) {
			$filters['idPelicula'] = $idPelicula;
		}

		$funciones = $this->funcionesService->list($filters);
		$resultado = [];

		foreach ($funciones as $funcion) {
			if (!$this->esFuncionDisponibleEnCatalogo($funcion)) {
				continue;
			}

			$resultado[] = $funcion;
		}

		usort($resultado, function (array $a, array $b): int {
			$fechaHoraA = ($a['fecha'] ?? '') . ' ' . ($a['hora'] ?? '00:00:00');
			$fechaHoraB = ($b['fecha'] ?? '') . ' ' . ($b['hora'] ?? '00:00:00');

			return strcmp($fechaHoraA, $fechaHoraB);
		});

		return $resultado;
	}

	private function esFuncionDisponibleEnCatalogo(array $funcion): bool
	{
		$fecha = (string)($funcion['fecha'] ?? '');
		$hora = (string)($funcion['hora'] ?? '00:00:00');

		if ($fecha === '') {
			return false;
		}

		$fechaHoraFuncion = new \DateTime($fecha . ' ' . $hora);

		if ($fechaHoraFuncion < new \DateTime()) {
			return false;
		}

		/** @var PeliculasDTO $pelicula */
		$pelicula = $this->peliculasService->load((int)$funcion['idPelicula']);
		if ($pelicula->getDisponibilidad() !== 1) {
			return false;
		}

		$sala = $this->salasService->load((int)$funcion['idSala']);
		if ($sala->getEstado() !== 1) {
			return false;
		}

		$programacion = $this->programacionService->load((int)$funcion['idProgramacion']);
		if ($programacion->getIdEstadoProgramacion() === ProgramacionService::ESTADO_CANCELADA) {
			return false;
		}

		return true;
	}

	//si la cantidad de entradas vendidas para la función es igual o mayor que la capacidad de la sala
	//no se puede comprar
	private function validarCapacidadDisponible(array $funcion): void
	{
		$sala = $this->salasService->load((int)$funcion['idSala']);
		$entradasVendidas = $this->entradasService->list([
			'idFuncion' => (int)$funcion['idFuncion'],
			'anulada' => 0
		]);

		if (count($entradasVendidas) >= $sala->getCapacidad()) {
			throw new \Exception("No hay cupos disponibles para la función seleccionada.");
		}
	}
}
