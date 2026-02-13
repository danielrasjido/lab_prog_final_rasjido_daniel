<?php

namespace app\core\service;

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\ComentariosDAO;
use app\core\model\dto\ComentariosDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;
use Exception;

final class ComentariosService implements InterfaceService{

    private ComentariosDAO $dao;

    public function __construct()
    {
        $this->dao = new ComentariosDAO(Connection::get());
    }

    public function load(int $id):InterfaceDto{

        $data = $this->dao->load($id);

        if($data === false){
            throw new \Exception("Comentario no encontrado.");
        }

        return new ComentariosDTO($data);
    }

    public function save(InterfaceDto $dto):void{
        $this->dao->save($dto->toArray());
    }

    public function update(InterfaceDto $dto):void{
        $this->dao->update($dto->toArray());
    }

    public function delete(InterfaceDto $dto):void{
        $data = $dto->toArray();
        $id = $data['idComentario'];
        $this->dao->delete($id);
    }
    
    public function list(array $filters):array{
        return $this->dao->list($filters);
    }
}