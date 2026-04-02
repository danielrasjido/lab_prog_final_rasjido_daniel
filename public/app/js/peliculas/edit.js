import { peliculasController } from "./controller.js";
document.addEventListener("DOMContentLoaded", event => {
    console.log("hola desde modulo peliculas dom cargado")
    const url = window.location.pathname.split('/');
    const indexUrl = window.location.pathname.replace(/\/edit\/\d+$/, '/index');
    console.log("url de indexurl:", indexUrl);
    const idPelicula = url[url.length - 1];
    console.log("ID de película extraído de la URL:", idPelicula);
    
    if (!idPelicula || isNaN(idPelicula)) {
    console.error("ID de película inválido");
    return;
    }
    peliculasController.load(parseInt(idPelicula));

    const botonValidarGuardar = document.querySelector("button[type=submit]");
    botonValidarGuardar.addEventListener("click", (event) =>{
        event.preventDefault();
        peliculasController.update();
    })

    const botonEditar = document.getElementById("btnEditar");
    botonEditar.addEventListener("click", ()=>{
        peliculasController.enableForm(true);
    })

    const botonCancelarEdicion = document.getElementById("btnCancelarEdicion");
    botonCancelarEdicion.addEventListener("click", () => {
        peliculasController.enableForm(false);
        peliculasController.resetForm();
    })

    const btnEliminarRegistro = document.getElementById("btnEliminarRegistro");
    btnEliminarRegistro.addEventListener("click", () => {
        //eliminamos el registro y volvemos a index
        peliculasController.delete(parseInt(idPelicula)).then( () => {window.location.href = indexUrl;} );
    });

})