import { entradasService } from "./service.js";


export const entradasController = {
    list: (filters) => {
        const listaEntradas = entradasService.list(filters)
            .then(response => response.json())
            .then(data => {
                //mostrarComentarios(data.result);
                console.log(data.result) 
            })
            .catch(error => {
                console.error("Error al cargar las entradas", error);
            });
    }
}

function mostrarEntradas(entradas) {

    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < entradas.length; i++) {
         let e = entradas[i];

         let tr = document.createElement("tr");

         tr.innerHTML = `
            <td>${e.idFuncion}</td>
            <td>${e.nombreUsuario}</td>
            <td>${e.fechaHora}</td>
            <td>
                <a href="usuario/edit/${comentario.idUsuario}" class="btn btn-primary">Suspender usuario</a>
                <button type="button" data-id-comentario=${comentario.idComentario} class="btn btn-danger btnEliminar">Eliminar comentario</button>
            </td>
        `;
         //insertamos la fila a la tabla
         tabla.appendChild(tr);
    }

    
}