import { comentariosController } from "./controller.js";

document.addEventListener("DOMContentLoaded", event =>{
    console.log("dom cargado dewsde modulo comentarios")
    comentariosController.list();


    //eliminar comentario
    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.addEventListener("click", event => {
        if(event.target.classList.contains("btnEliminar")){
            const idComentario = parseInt(event.target.dataset.idComentario);
            console.log("eliminando el comentario ", idComentario);
            comentariosController.delete(idComentario).then(() => {
                comentariosController.list();
                console.log("Listar");
            }).catch(error => {
                console.error("Error al eliminar el comentario", error);
            });
        }
        
    })
})