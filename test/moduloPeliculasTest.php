<?php

declare(strict_types=1);

use app\core\model\dto\PeliculasDTO;
use app\core\service\PeliculasService;

require_once __DIR__ . '/../app/config/DBConfig.php';
require_once __DIR__ . '/../vendor/autoload.php';

try {
    /*

    "result": {
        "idPelicula": 1,
        "nombre": "El Viaje Final",
        "tituloOriginal": "The Final Journey",
        "duracion": 125,
        "fechaEstreno": "2022-06-15",
        "disponibilidad": 1,
        "fechaIngreso": "2024-08-01",
        "sitioWeb": "https://www.elviajefinal.com",
        "sinopsis": "Una aventura épica sobre el destino y la redención.",
        "imagenCartelera": "viaje_final.jpg",
        "actores": "Actor Uno, Actor Dos",
        "genero": "Aventura",
        "pais": "Estados Unidos",
        "idiomas": "Español, Inglés",
        "calificacion": 0
    }
     
     */
    $pelicula = [
        "nombre" => "Matrix",
        "tituloOriginal" => "The Matrix",
        "duracion" => 136,
        "fechaEstreno" => "1999-03-31",
        "disponibilidad" => 1,
        "fechaIngreso" => "2024-08-01",
        "sitioWeb" => "https://www.lamatrix.com",
        "sinopsis" => "Un hacker descubre la verdad sobre su realidad y su papel en la guerra contra sus controladores.",
        "imagenCartelera" => "matrix.jpg",
        "actores" => "Keanu Reeves, Laurence Fishburne",
        "genero" => "Ciencia Ficción",
        "pais" => "Estados Unidos",
        "idiomas" => "Español, Inglés",
        "calificacion" => "PG-13"
    ];

    $pService = new PeliculasService();
    $dto = new PeliculasDTO($pelicula);
    $dto->setIdPelicula(5);
    $pService->delete($dto);


    



} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}