import {peliculasService} from './service.js';


export const peliculasController = {
    load: (id) => {
        peliculasService.load(id)
            .then(response => {
                const pelicula = response;
            
            if(!pelicula){
                console.error("no existe la pelicula")
                console.log(pelicula)
                //añadir toast
                return
            }

            document.getElementById("datoNombrePelicula").value = pelicula.nombre;
            document.getElementById("datoImagenCartelera").value = pelicula.imagenCartelera;
            document.getElementById("datoActores").value = pelicula.actores;
            document.getElementById("datoSinopsis").value = pelicula.sinopsis;
            document.getElementById("datoDuracion").value = pelicula.duracion;
            document.getElementById("datoGenero").value = pelicula.genero;
            document.getElementById("datoIdiomas").value = pelicula.idiomas;
            document.getElementById("datoPais").value = pelicula.pais;
            document.getElementById("datoCalificacion").value = pelicula.calificacion;
            document.getElementById("datoTituloOriginal").value = pelicula.tituloOriginal;
            document.getElementById("datoSitioWeb").value = pelicula.sitioWeb;
            document.getElementById("datoFechaEstreno").value = pelicula.fechaEstreno;
            document.getElementById("datoFechaIngreso").value = pelicula.fechaIngreso;
            document.getElementById("datoDisponibilidad").value = pelicula.disponibilidad;
            })
             .catch(error => {
            console.error("Error al cargar película:", error.message);
        });
    },
    save: () => {
        const pelicula = capturarDatosPelicula();
        if(!pelicula){
            console.error("no se pudo capturar la pelicula");
        }
        peliculasService.save(pelicula).then(response => {
            if(response.error){
                console.error("no se pudo guardar la pelicula" + error);
                //añadir toast mas adelante
            } else {
                console.log("pelicula guardada con exito");
                //añadir toast mas adelante
            }
        })
    },
    update: () => {
        const pelicula = capturarDatosPelicula();
        if(!pelicula){
            console.error("no se pudo capturar la pelicula");
        }
        peliculasService.update(pelicula).then(response => {
            if(response.error){
                console.error("no se pudo actualizar la pelicula" + error);
                //añadir toast mas adelante
            } else {
                console.log("pelicula actualizada con exito");
                //añadir toast mas adelante
            }
        })
    },
    delete: (id) => {
        if (!confirm("¿Está seguro que desea eliminar esta película? Esta acción no se puede deshacer.")) {
            return;
        }
        peliculasService.delete(id).then(response => {
            if(response.error){
                console.error("no se pudo eliminar la pelicula" + error);
                //añadir toast mas adelante
            } else {
                console.log("pelicula eliminada con exito");
                //añadir toast mas adelante
            }
        })
    },
    list: (filters) => {
        peliculasService.list(filters).then(peliculas => mostrarPeliculas(peliculas))
    },
    enableForm: () => {
        let listaBotones = document.querySelectorAll('.control');
        let botonActualizar = document.getElementById("btnActualizar");
        let botonCancelarEdicion = document.getElementById("btnCancelarEdicion");



        if (estado) {
            botonActualizar.disabled = false;
            botonCancelarEdicion.disabled = false;
            listaBotones.forEach(boton => {
                boton.disabled = false;
            });
        } else {
            botonActualizar.disabled = true;
            botonCancelarEdicion.disabled = true;
            listaBotones.forEach(boton => {
                boton.disabled = true;
            });
        }
    },
    resetForm: () => {
        const url = window.location.pathname.split('/'); //devuelve la url divida en arraay
        
        const idFinal = url[url.length - 1]; //devuelve la ultima parte de la url, que es el id
        peliculasController.load(parseInt(idFinal));
        peliculasController.enableForm(false);
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

    


}

function capturarDatosPelicula(){

        const dtNombrePelicula = document.getElementById("datoNombrePelicula").value.trim();
        const dtImagenCartelera = document.getElementById("datoImagenCartelera").value.trim();
        const dtActores = document.getElementById("datoActores").value.trim();
        const dtSinopsis = document.getElementById("datoSinopsis").value.trim();
        const dtDuracion = document.getElementById("datoDuracion").value.trim();
        const dtGenero = document.getElementById("datoGenero").value.trim();
        const dtIdiomas = document.getElementById("datoIdiomas").value.trim();
        const dtPais = document.getElementById("datoPais").value.trim();
        const dtCalificacion = document.getElementById("datoCalificacion").value.trim();
        const dtTituloOriginal = document.getElementById("datoTituloOriginal").value.trim();
        const dtSitioWeb = document.getElementById("datoSitioWeb").value.trim();
        const dtFechaEstreno = document.getElementById("datoFechaEstreno").value.trim();
        const dtFechaIngreso = document.getElementById("datoFechaIngreso").value.trim();
        const dtDisponibilidad = parseInt(document.getElementById("datoDisponibilidad").value);

        let pelicula = {
            nombre: dtNombrePelicula,
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