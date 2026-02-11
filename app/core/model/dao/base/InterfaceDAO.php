<?php

namespace app\core\model\dao\base;

interface InterfaceDAO{

    public function load(int $id):array|false;

    public function save(array $data):void;
    
    //necesita id
    public function update(array $data):void;

    public function delete(int $id):void;

    public function list(array $filters):array;

    public function suggestive(array $filters):array; //por cada letra busca en el back

    public function foundRows():int; //devuelve la cant total de arreglos antes del filtrado (si se hace paginacion)
    //por ejemplo, si tengo 1000 items, voy a querer mostrar un mensaje que diga 
    //1000 items encontrados aunque solo se muestren 50

    public function countRows():int;

    public function getLastInsertId():int;


}