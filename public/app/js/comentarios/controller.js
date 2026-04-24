import { comentariosService } from "./service.js";


export const comentariosController = {
    list: (filters) => {
        const listaComentarios = comentariosService.list(filters)
            .then(response => response.json())
            .then(data => {
                mostrarComentarios(data.result);  
            })
            .catch(error => {
                console.error("Error al cargar los comentarios", error);
            });
    },
    delete: (id) => {
        if (!confirm("¿Está seguro que desea eliminar este comentario? Esta acción no se puede deshacer.")) {
            return Promise.resolve();
        }
        return comentariosService.delete(id);
    }

}

function mostrarComentarios(comentarios) {

    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < comentarios.length; i++) {
         let comentario = comentarios[i];

         let tr = document.createElement("tr");

         tr.innerHTML = `
            <td>${comentario.nombreUsuario}</td>
            <td>${comentario.tituloPelicula}</td>
            <td>${comentario.comentario}</td>
            <td>
                <button type="button" data-id-comentario=${comentario.idComentario} class="btn btn-danger btnEliminar">Eliminar comentario</button>
            </td>
        `;
         //insertamos la fila a la tabla
         tabla.appendChild(tr);
    }

    
}