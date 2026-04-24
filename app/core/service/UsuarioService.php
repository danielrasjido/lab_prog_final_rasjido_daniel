<?php

namespace app\core\service;

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;
use Exception;

final class UsuarioService implements InterfaceService{

    private UsuarioDAO $dao;
    private EntradasService $entradasService;
    private ComentariosService $comentariosService;

    public function __construct()
    {
        $this->dao = new UsuarioDAO(Connection::get());
        $this->entradasService = new EntradasService();
        $this->comentariosService = new ComentariosService();
    }

    public function load(int $id):InterfaceDto{

        $data = $this->dao->load($id);

        if($data === false){
            throw new \Exception("Usuario no encontrado.");
        }

        return new UsuarioDTO($data);
    }

    public function save(InterfaceDto $dto):void{
        $this->dao->save($dto->toArray());
    }

    public function update(InterfaceDto $dto):void{
        $this->dao->update($dto->toArray());
    }

    public function delete(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $id = (int)$data['idUsuario'];

        $entradasAsociadas = $this->entradasService->list([
            'idUsuario' => $id
        ]);

        if (count($entradasAsociadas) > 0) {
            throw new \Exception("No se permite borrar un usuario asociado a entradas.");
        }

        $comentariosAsociados = array_values(array_filter(
            $this->comentariosService->list([]),
            fn(array $comentario): bool => (int)($comentario['idUsuario'] ?? 0) === $id
        ));

        if (count($comentariosAsociados) > 0) {
            throw new \Exception("No se permite borrar un usuario asociado a comentarios.");
        }

        $this->dao->delete($id);
    }
    
    public function list(array $filters):array{
        return $this->dao->list($filters);
    }
}