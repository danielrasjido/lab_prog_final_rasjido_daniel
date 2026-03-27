import {peliculasService} from './service.js';


export const peliculasController = {
    load: (id) => {

    },
    list: (filters) => {
        mostrarPeliculas(peliculasService.list({}));
    }
}

function mostrarPeliculas(peliculas){
    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < peliculas.length; i++) {
        console.log("mensaje bucle")
        console.log[i];
        //guardamos peli
        let p = peliculas[i];
        //creamos fila :)
        let tr = document.createElement("tr");
        //modificamos el contenido de la fila
        tr.innerHTML = `
            <td>${p.idPelicula}</td>
            <td>${p.nombre}</td>
            <td>${p.tituloOriginal}</td>
            <td>${p.duracion}</td>
            <td>${p.disponibilidad}</td>
            <td>${p.sitioWeb}</td>
            <td>${p.sinopsis}</td>
            <td>${p.imagenCartelera}</td>
            <td>${p.actores}</td>
            <td>${p.genero}</td>
            <td>${p.pais}</td>
            <td>${p.idiomas}</td>
            <td>${p.calificacion}</td>
            <td>${p.fechaEstreno}</td>
            <td>${p.fechaIngreso}</td>
            <td>
                <a href="peliculas/edit/${p.idPelicula}" class="btn btn-primary">Modificar</a>
                <button type="button" data-id-usuario=${p.idPelicula} class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
        `;
        //insertamos la fila a la tabla
        tabla.appendChild(tr);
    }
}