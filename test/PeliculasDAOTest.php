<?php

require_once __DIR__ . '/../vendor/autoload.php';
use app\core\model\dao\PeliculasDAO;
use app\libs\database\Connection;

try{
    $dao = new PeliculasDAO(Connection::get());

    print_r($dao->load(1));

    $p1 = [
        "nombre" => "Pelicula de prueba",
        "tituloOriginal" => "Test Movie",
        "duracion" => 120,
        "fechaEstreno" => "2024-01-01",
        "disponibilidad" => 1,
        "fechaIngreso" => date("Y-m-d"),
        "sitioWeb" => "https://www.testmovie.com",
        "sinopsis" => "Esta es una película de prueba para testing.",
        "imagenCartelera" => "https://www.testmovie.com/poster.jpg",
        "actores" => "Actor 1, Actor 2, Actor 3",
        "genero" => "Acción",
        "pais" => "Estados Unidos",
        "idiomas" => "Español, Inglés",
        "calificacion" => 8.5
    ];

    $dao->save($p1);

    $p1Update = [
        "idPelicula" => 3,
        "nombre" => "UPDATEEEE",
        "tituloOriginal" => "update",
        "duracion" => 120,
        "fechaEstreno" => "2024-01-01",
        "disponibilidad" => 1,
        "fechaIngreso" => date("Y-m-d"),
        "sitioWeb" => "https://www.testmovie.com",
        "sinopsis" => "Esta es una película de prueba para testing.",
        "imagenCartelera" => "https://www.testmovie.com/poster.jpg",
        "actores" => "Actor 1, Actor 2, Actor 3",
        "genero" => "Acción",
        "pais" => "Estados Unidos",
        "idiomas" => "Español, Inglés",
        "calificacion" => 8.5
    ];

    //$dao->delete();

}catch(\Exception $ex){
    print_r("<p>" . $ex->getMessage() . "</p>");
}