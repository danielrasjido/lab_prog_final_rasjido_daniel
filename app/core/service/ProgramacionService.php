<?php

namespace app\core\service;

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\ProgramacionDAO;
use app\core\model\dto\ProgramacionDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;
use Exception;


final class ProgramacionService implements InterfaceService
{

    public const ESTADO_CANCELADA = 1;
    public const ESTADO_VIGENTE = 2;
    public const ESTADO_PROGRAMADA = 3;
    public const ESTADO_VIGENTE_EXCEPCION = 4;

    private ProgramacionDAO $dao;

    public function __construct()
    {
        $this->dao = new ProgramacionDAO(Connection::get());
    }

    public function load(int $id): ProgramacionDTO
    {

        $data = $this->dao->load($id);

        if ($data === false) {
            throw new \Exception("Programación no encontrada.");
        }

        return new ProgramacionDTO($data);
    }

    public function save(InterfaceDto $dto): void
    {
        $data = $dto->toArray();
        $data['idEstadoProgramacion'] = $this->normalizarEstadoProgramacion(
            $data['idEstadoProgramacion'] ?? self::ESTADO_PROGRAMADA
        );

        $this->validarSemanaProgramacion(
            new \DateTime($data['fechaInicio']),
            new \DateTime($data['fechaFin']),
            (int)$data['idEstadoProgramacion']
        );

        $this->validarProgramacionExistente(new ProgramacionDTO($data));

        $this->dao->save($data);
        $this->sincronizarProgramacionVigenteActual();
    }

    public function update(InterfaceDto $dto): void
    {
        $data = $dto->toArray();
        $data['idEstadoProgramacion'] = $this->normalizarEstadoProgramacion(
            $data['idEstadoProgramacion'] ?? self::ESTADO_PROGRAMADA
        );

        $this->validarSemanaProgramacion(
            new \DateTime($data['fechaInicio']),
            new \DateTime($data['fechaFin']),
            (int)$data['idEstadoProgramacion']
        );

        $this->dao->update($data);
        $this->sincronizarProgramacionVigenteActual();
    }

    public function delete(InterfaceDto $dto): void
    {
        $data = $dto->toArray();
        $id = $data['idProgramacion'];
        $this->dao->delete($id);
    }

    public function list(array $filters): array
    {
        $this->sincronizarProgramacionVigenteActual();
        return $this->dao->list($filters);
    }

    private function normalizarEstadoProgramacion(int $idEstadoProgramacion): int
    {
        $estadosValidos = [
            self::ESTADO_CANCELADA,
            self::ESTADO_VIGENTE,
            self::ESTADO_PROGRAMADA,
            self::ESTADO_VIGENTE_EXCEPCION
        ];

        if (!in_array($idEstadoProgramacion, $estadosValidos, true)) {
            return self::ESTADO_PROGRAMADA;
        }

        return $idEstadoProgramacion;
    }

    /**
     * validamos que la programación sea de 7 dias, de domingo a domingo
     */
    public function validarSemanaProgramacion(\DateTime $fechaInicio, \DateTime $fechaFin, int $idEstadoProgramacion): void
    {
        // Normalizamos hora para comparar solo fecha
        $inicio = (clone $fechaInicio)->setTime(0, 0, 0);
        $fin = (clone $fechaFin)->setTime(0, 0, 0);

        if ($fin < $inicio) {
            throw new \Exception("La fecha de fin no puede ser anterior a la fecha de inicio.");
        }

        if ($idEstadoProgramacion === self::ESTADO_VIGENTE_EXCEPCION) {
            if ((int)$inicio->format('w') === 0) {
                throw new \Exception("La programación de excepción no puede iniciar en domingo.");
            }

            // Para excepciones, debe terminar el sábado de esa semana.
            $diasHastaSabado = 6 - (int)$inicio->format('w');
            $finEsperado = (clone $inicio)->modify('+' . $diasHastaSabado . ' days');

            if ($fin->format('Y-m-d') !== $finEsperado->format('Y-m-d')) {
                throw new \Exception("La programación de excepción debe terminar el sábado de la semana de inicio.");
            }

            return;
        }

        // format retorna el dia de la semana con un número, empieza con 0 que corresponde a domingo hasta sabádo que es 6
        if ((int)$inicio->format('w') !== 0) {
            throw new \Exception("La fecha de inicio debe ser domingo.");
        }

        $finEsperado = (clone $inicio)->modify('+6 days');

        if ($fin->format('Y-m-d') !== $finEsperado->format('Y-m-d')) {
            throw new \Exception("La fecha de fin debe ser exactamente 6 días después de la fecha de inicio.");
        }
    }

    public function validarProgramacionExistente(ProgramacionDTO $dto): void
    {
        $data = $dto->toArray();
        $fechaInicio = new \DateTime($data['fechaInicio']);

        $programacionesExistentes = $this->dao->list([]);
        $fechaInicioBuscada = $fechaInicio->format('Y-m-d');

        foreach ($programacionesExistentes as $programacion) {
            if ((int)$programacion['idEstadoProgramacion'] === self::ESTADO_CANCELADA) {
                continue;
            }

            if ($programacion['fechaInicio'] === $fechaInicioBuscada) {
                throw new \Exception("Ya existe una programación activa que inicia el " . $fechaInicioBuscada . ".");
            }
        }

    }


    public function cancelarProgramacion(int $idProgramacion): void
    {
        $this->dao->cancelarProgramacion($idProgramacion);
        $this->sincronizarProgramacionVigenteActual();
    }

    private function sincronizarProgramacionVigenteActual(): void
    {
        $programaciones = $this->dao->list([]);
        $hoy = (new \DateTime())->setTime(0, 0, 0);
        $programacionActual = null;

        foreach ($programaciones as $programacion) {
            $estado = (int)$programacion['idEstadoProgramacion'];

            if ($estado === self::ESTADO_CANCELADA) {
                continue;
            }

            $inicio = (new \DateTime($programacion['fechaInicio']))->setTime(0, 0, 0);
            $fin = (new \DateTime($programacion['fechaFin']))->setTime(0, 0, 0);

            if ($hoy < $inicio || $hoy > $fin) {
                if ($estado === self::ESTADO_VIGENTE) {
                    $this->dao->actualizarEstadoProgramacion((int)$programacion['idProgramacion'], self::ESTADO_PROGRAMADA);
                }
                continue;
            }

            if ($programacionActual === null) {
                $programacionActual = $programacion;
                continue;
            }

            if ((int)$programacion['idEstadoProgramacion'] === self::ESTADO_VIGENTE_EXCEPCION
                && (int)$programacionActual['idEstadoProgramacion'] !== self::ESTADO_VIGENTE_EXCEPCION) {
                $programacionActual = $programacion;
            }
        }

        if ($programacionActual === null) {
            return;
        }

        foreach ($programaciones as $programacion) {
            $idProgramacion = (int)$programacion['idProgramacion'];
            $estado = (int)$programacion['idEstadoProgramacion'];

            if ($idProgramacion === (int)$programacionActual['idProgramacion']) {
                if ($estado !== self::ESTADO_VIGENTE) {
                    $this->dao->actualizarEstadoProgramacion($idProgramacion, self::ESTADO_VIGENTE);
                }
                continue;
            }

            if ($estado === self::ESTADO_VIGENTE) {
                $this->dao->actualizarEstadoProgramacion($idProgramacion, self::ESTADO_PROGRAMADA);
            }
        }
    }

}
