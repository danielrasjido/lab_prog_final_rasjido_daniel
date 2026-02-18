<?php

use app\core\model\dto\ComentariosDTO;
use app\core\service\ComentariosService;

require_once __DIR__ . '/../app/config/DBConfig.php';
require_once __DIR__ . '/../vendor/autoload.php';

try{

    //PROBAR: LOAD, SAVE, UPDATE, DELETE Y LIST

    $serviceComentarios = new ComentariosService;
    $comentario = [
        "idUsuario" => 1,
        "idPelicula" => 3,
        "comentario" => "Este es un comentario de prueba.",
        "fechaHora" => "2024-08-01 12:00:00"
    ];

    $comentarioDTO = new ComentariosDTO($comentario);


    //LOAD

    //echo print_r($serviceComentarios->load(1));

    //SAVE

    //$serviceComentarios->save($comentarioDTO);

    //UPDATE

    $comentarioDTO->setComentario("Este es un comentario actualizado.");
    $comentarioDTO->setIdComentario(4);
    $serviceComentarios->update($comentarioDTO);

    //DELETE

    //$serviceComentarios->delete($comentarioDTO);

    //LIST
    echo print_r($serviceComentarios->list(["idPelicula" => 3]));
    

}catch(\Exception $ex){
    echo "<p>" . $ex->getMessage() ."</p>";
}