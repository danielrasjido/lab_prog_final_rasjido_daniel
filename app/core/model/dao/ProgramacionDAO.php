<?php

namespace app\core\model\dao;

use app\core\model\dao\base\BaseDAO;
use app\core\model\dao\base\InterfaceDAO;
use Exception;
use PDO;

final class ProgramacionDAO extends BaseDAO {

	protected $connection;
	protected $table;

	public function __construct(?\PDO $connection)
	{
		$this->connection = $connection;
		$this->table = 'programacion';
	}

	public function load(int $id): array|false
	{
		$arreglo = [];

		$consulta = "SELECT * FROM {$this->table} WHERE idProgramacion = :id";
		$stmt = $this->connection->prepare($consulta);
		$stmt->execute([":id" => $id]);

		$arreglo = $stmt->fetch(PDO::FETCH_ASSOC);

		return $arreglo;
	}

	public function save(array $data): void
	{
		$sql = "INSERT INTO {$this->table}
		(fechaInicio,
		fechaFin) VALUES (
		:fechaInicio,
		:fechaFin)";

		$stmt = $this->connection->prepare($sql);
		$stmt->execute([
			"fechaInicio" => $data["fechaInicio"],
			"fechaFin" => $data["fechaFin"]
		]);
	}

	public function update(array $data): void
	{
		$sql = "UPDATE {$this->table} SET
		fechaInicio = :fechaInicio,
		fechaFin = :fechaFin
		WHERE idProgramacion = :idProgramacion";

		$stmt = $this->connection->prepare($sql);
		$stmt->execute([
			"fechaInicio" => $data["fechaInicio"],
			"fechaFin" => $data["fechaFin"],
			"idProgramacion" => $data["idProgramacion"]
		]);
	}

	public function delete(int $id): void
	{
		$sql = "DELETE FROM {$this->table} WHERE idProgramacion = :id";
		$stmt = $this->connection->prepare($sql);
		$stmt->execute(["id" => $id]);
	}

	public function list(array $filters): array
	{
		$resultado = [];
		$parametros = [];

		$sql = "SELECT * FROM {$this->table} WHERE 1=1";

		if(isset($filters["idProgramacion"])){
			$sql .= " AND idProgramacion = :idProgramacion";
			$parametros["idProgramacion"] = $filters["idProgramacion"];
		}

		if(!empty($filters["fechaInicio"])){
			$sql .= " AND fechaInicio >= :fechaInicio";
			$parametros["fechaInicio"] = $filters["fechaInicio"];
		}

		if(!empty($filters["fechaFin"])){
			$sql .= " AND fechaFin <= :fechaFin";
			$parametros["fechaFin"] = $filters["fechaFin"];
		}

		$stmt = $this->connection->prepare($sql);
		$stmt->execute($parametros);
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $resultado;
	}

	public function suggestive(array $filters): array
	{
		throw new \Exception('Not implemented');
	}

}

