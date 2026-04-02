import { peliculasController } from './controller.js';

document.addEventListener("DOMContentLoaded", event => {
    console.log("modulo peliculas index.js cargado")
    peliculasController.list({});


    //boton eliminar
    document.getElementById("cuerpoDeLaTabla").addEventListener("click", (e) => {
        if (e.target.classList.contains("btnEliminar")) {
            const id = parseInt(e.target.dataset.idPelicula);
            peliculasController.delete(id)
            .then(() => peliculasController.list({}))
            .catch(err => console.error(err));;
        }
    });
})