<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\model\dto\PeliculasDTO;
use app\core\service\PeliculasService;
use app\core\controller\PeliculasController;

try{

    $pService = new PeliculasService();

    $pelicula = [
        'idPelicula' => 7,
        'nombre' => 'El Padrino',
        'tituloOriginal' => 'The Godfather',
        'duracion' => 175,
        'fechaEstreno' => '1972-03-24',
        'disponibilidad' => 1,
        'fechaIngreso' => date('Y-m-d'),
        'sitioWeb' => 'https://www.thegodfather.com',
        'sinopsis' => 'La historia de la familia Corleone, una de las más poderosas familias mafiosas de Nueva York.',
        'imagenCartelera' => 'https://example.com/godfather.jpg',
        'actores' => 'Marlon Brando, Al Pacino, James Caan',
        'genero' => 'Crimen, Drama',
        'pais' => 'Estados Unidos',
        'idiomas' => 'Inglés, Italiano',
        'calificacion' => "R15"
    ];  
    
    $peliculaDto = new PeliculasDTO($pelicula);
    $peliculaDto->setNombre("Cumbres borrascosas");
    $peliculaDto->setActores("Margot Robbie");
    $peliculaDto->setTituloOriginal("ASDKJLAFKLDSJFKJLD");

    
   // echo json_encode($pService->list(["calificacion" => "8.5"]));

    

    $controller = new PeliculasController();

    $pelicula2 = [
        "idPelicula" => 7,
        "nombre" => "Crepusculo",
        "tituloOriginal" => "Twilight",
        "duracion" => 120,
        "fechaEstreno" => "2008-11-21",
        "disponibilidad" => 1,
        "fechaIngreso" => date('Y-m-d'),
        "sitioWeb" => "https://www.twilight.com",
        "sinopsis" => "La historia de amor entre una humana y un vampiro.",
        "imagenCartelera" => "https://example.com/twilight.jpg",
        "actores" => "Kristen Stewart, Robert Pattinson, Taylor Lautner",
        "genero" => "Romance, Fantasía",
        "pais" => "Estados Unidos",
        "idiomas" => "Inglés",
        "calificacion" => "PG-13"
    ];


    $controller->save(new PeliculasDTO($pelicula2));




}catch(\Exception $ex){
    echo print_r($ex->getMessage());
}