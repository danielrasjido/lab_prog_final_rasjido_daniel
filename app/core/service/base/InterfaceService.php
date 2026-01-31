<?php

namespace app\core\service\base;
use app\core\model\dto\base\InterfaceDto;

interface InterfaceService{

    /**
     * 
     * @param 
     */
    public function load(int $id):InterfaceDto;
    public function save(InterfaceDto $dto):void;
    public function update(InterfaceDto $dto):void;
    public function delete(InterfaceDto $dto):void;
    public function list(array $filters):array;

}