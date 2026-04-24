<?php

namespace app\core\service;

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\FuncionesDAO;
use app\core\model\dto\FuncionesDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\model\dto\SalasDTO;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;
use Exception;

final class FuncionesService implements InterfaceService{
    private FuncionesDAO $dao;

    public function __construct()
    {
        $this->dao = new FuncionesDAO(Connection::get());
    }

    public function load(int $id):FuncionesDTO{

        $data = $this->dao->load($id);

        if($data === false){
            throw new \Exception("Función no encontrada.");
        }

        return new FuncionesDTO($data);
    }

    public function save(InterfaceDto $dto):void{
        if (!($dto instanceof FuncionesDTO)) {
            throw new \Exception("El DTO recibido no corresponde a una función.");
        }


        //esta por si acaso
        $this->validarFechaFuncionPosteriorActual($dto->getFecha());

        //primera validacion...
        $this->validarSalaHabilitada($dto->getIdSala());

        // La programación se asigna automáticamente según la fecha de la función.
        $idProgramacion = $this->obtenerProgramacionPorFecha($dto->getFecha());
        $dto->setIdProgramacion($idProgramacion);

        //tercera validacion
        $this->validarFuncionExistente($dto);

        $this->dao->save($dto->toArray());
    }

    public function update(InterfaceDto $dto):void{
        if (!($dto instanceof FuncionesDTO)) {
            throw new \Exception("El DTO recibido no corresponde a una función.");
        }

        $this->validarFechaFuncionPosteriorActual($dto->getFecha());

        $this->dao->update($dto->toArray());
    }

    public function delete(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $id = $data['idFuncion'];
        $this->dao->delete($id);
    }
    
    public function list(array $filters):array{
        return $this->dao->list($filters);
    }

   

    //primera validacion
    //validamos que la sala seleccionada tenga estado = 1
    public function validarSalaHabilitada(int $idSala): void{
        $salaService = new SalasService();
        $salaDTO = $salaService->load($idSala);
        if($salaDTO->getEstado() != 1){
            throw new \Exception("La sala seleccionada no está habilitada.");
        }
    }


    //segunda validacion, la programación asociada no debe estar cancelada
    public function validarProgramacionVigente(int $idProgramacion): void{
        $programacionService = new ProgramacionService();
        $programacionDTO = $programacionService->load($idProgramacion);
        if($programacionDTO->getIdEstadoProgramacion() == ProgramacionService::ESTADO_CANCELADA){
            throw new \Exception("La programación seleccionada está cancelada.");
        }
    }

    //tercera validación, cuando se crea una función, no debe haber otra función en la misma ahora A NO SER que las salas sean distintas
    public function validarFuncionExistente(FuncionesDTO $funcionDTO): void{

        //listamos las funciones que tengan la misma fecha hora y sala 
        $funciones = $this->dao->list([
            "idSala" => $funcionDTO->getIdSala(),
            "fecha" => $funcionDTO->getFecha()->format("Y-m-d"),
            "hora" => $funcionDTO->getHora()->format("H:i:s")
        ]);

        //si existe al menos una con la misma fecha, hora y sala, se lanza excepcion 
        if (count($funciones) > 0) {
            throw new \Exception("Ya existe una función programada para la misma fecha, hora y sala.");
        }
    }


    //cuarta validacion? al crear una función, "en función" de la fecha (valga la redundancia) se debe asignar a una programación con la misma fecha
    //probar? ni siquiera me atrevo, por dios que funcione
    private function obtenerProgramacionPorFecha(\DateTime $fechaFuncion): int
    {
        $programacionService = new ProgramacionService();
        $programaciones = $programacionService->list([]);

        $coincidencias = [];
        $fechaObjetivo = (clone $fechaFuncion)->setTime(0, 0, 0);

        foreach ($programaciones as $programacion) {
            if ((int)$programacion["idEstadoProgramacion"] === ProgramacionService::ESTADO_CANCELADA) {
                continue;
            }

            $inicio = (new \DateTime($programacion["fechaInicio"]))->setTime(0, 0, 0);
            $fin = (new \DateTime($programacion["fechaFin"]))->setTime(0, 0, 0);

            if ($fechaObjetivo >= $inicio && $fechaObjetivo <= $fin) {
                $coincidencias[] = $programacion;
            }
        }

        if (count($coincidencias) === 0) {
            throw new \Exception("No existe una programación activa para la fecha seleccionada.");
        }

        foreach ($coincidencias as $programacion) {
            if ((int)$programacion["idEstadoProgramacion"] === ProgramacionService::ESTADO_VIGENTE) {
                return (int)$programacion["idProgramacion"];
            }
        }

        if (count($coincidencias) > 1) {
            throw new \Exception("Existe más de una programación activa para la fecha seleccionada.");
        }

        return (int)$coincidencias[0]["idProgramacion"];
    }

     private function validarFechaFuncionPosteriorActual(\DateTime $fechaFuncion): void
    {
        $hoy = (new \DateTime())->setTime(0, 0, 0);
        $fecha = (clone $fechaFuncion)->setTime(0, 0, 0);

        if ($fecha <= $hoy) {
            throw new \Exception("La fecha de la función debe ser posterior a la fecha actual del sistema.");
        }
    }

}