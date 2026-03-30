import {peliculasService} from './service.js';


export const peliculasController = {
    load: (id) => {

    },
    save: () => {
        const pelicula = capturarDatosPeliculaSave();
        if(!pelicula){
            console.error("no se pudo capturar la pelicula");
        }
        peliculasService.save(pelicula).then(response => {
            if(response.success){
                console.log("pelicula guardada con exito");
                //añadir toast mas adelante
            } else {
                console.error("no se pudo guardar la pelicula");
                //añadir toast mas adelante
            }
        })
    },
    list: (filters) => {
        peliculasService.list(filters).then(peliculas => mostrarPeliculas(peliculas))
    }
}

function mostrarPeliculas(peliculas){
    console.log("mostrar peliculas")
    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < peliculas.length; i++) {
        console.log("bucle")
        console.log("mensaje bucle")
        console.log(i);
        //guardamos peli
        let p = peliculas[i];
        //creamos fila :)
        let tr = document.createElement("tr");
        //modificamos el contenido de la fila
        tr.innerHTML = `
            <td>${p.idPelicula}</td>
            <td>${p.imagenCartelera}</td>
            <td>${p.nombre}</td>
            <td>${p.actores}</td>
            <td>${p.sinopsis}</td>
            <td>${p.duracion}</td>
            <td>${p.genero}</td>
            <td>${p.idiomas}</td>
            <td>${p.pais}</td>
            <td>${p.calificacion}</td>
            <td>${p.tituloOriginal}</td>
            <td>${p.sitioWeb}</td>
            <td>${p.fechaEstreno}</td>
            <td>${p.fechaIngreso}</td>
            <td>${p.disponibilidad}</td>
            <td>
                <a href="peliculas/edit/${p.idPelicula}" class="btn btn-primary">Modificar</a>
                <button type="button" data-id-usuario=${p.idPelicula} class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
        `;
        //insertamos la fila a la tabla
        tabla.appendChild(tr);
    }

    function capturarDatosPeliculaSave(){

        dtNombrePelicula = document.getElementById("datoNombrePelicula").value.trim();
        dtImagenCartelera = document.getElementById("datoImagenCartelera").value.trim();
        dtActores = document.getElementById("datoActores").value.trim();
        dtSinopsis = document.getElementById("datoSinopsis").value.trim();
        dtDuracion = document.getElementById("datoDuracion").value.trim();
        dtGenero = document.getElementById("datoGenero").value.trim();
        dtIdiomas = document.getElementById("datoIdiomas").value.trim();
        dtPais = document.getElementById("datoPais").value.trim();
        dtCalificacion = document.getElementById("datoCalificacion").value.trim();
        dtTituloOriginal = document.getElementById("datoTituloOriginal").value.trim();
        dtSitioWeb = document.getElementById("datoSitioWeb").value.trim();
        dtFechaEstreno = document.getElementById("datoFechaEstreno").value.trim();
        dtFechaIngreso = document.getElementById("datoFechaIngreso").value.trim();
        dtDisponibilidad = document.getElementById("datoDisponibilidad").value.trim();

        let pelicula = {
            nombrePelicula: dtNombrePelicula,
            imagenCartelera: dtImagenCartelera,
            actores: dtActores,
            sinopsis: dtSinopsis,
            duracion: dtDuracion,
            genero: dtGenero,
            idiomas: dtIdiomas,
            pais: dtPais,
            calificacion: dtCalificacion,
            tituloOriginal: dtTituloOriginal,
            sitioWeb: dtSitioWeb,
            fechaEstreno: dtFechaEstreno,
            fechaIngreso: dtFechaIngreso,
            disponibilidad: dtDisponibilidad
        }

        return pelicula;

    }


}

/**
 
idPelicula
imagenCartelera
nombre
actores
sinopsis
duracion
genero
idiomas
pais
calificacion
tituloOriginal
sitioWeb
fechaEstreno
fechaIngreso
disponibilidad
 */