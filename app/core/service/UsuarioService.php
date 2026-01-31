<?php

use app\core\model\dao\base\InterfaceDAO;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;
use app\core\model\dto\base\InterfaceDto;
use app\core\service\base\InterfaceService;
use app\libs\database\Connection;

final class UsuarioService implements InterfaceService{

    private UsuarioDAO $dao;

    public function __construct()
    {
        $this->dao = new UsuarioDAO(Connection::get());
    }

    public function load(int $id):InterfaceDto{
        return new UsuarioDTO($this->dao->load($id));
    }
    
    public function save(InterfaceDto $dto):void{

    }
    public function update(InterfaceDto $dto):void{

    }
    public function delete(InterfaceDto $dto):void{

    }
    public function list(array $filters):array{
        return [];
    }
}