import { entradasService } from "./service.js";


export const entradasController = {
    list: (filters) => {
        const listaEntradas = entradasService.list(filters)
            .then(response => response.json())
            .then(data => {
                mostrarEntradas(data.result);
                console.log(data.result) 
            })
            .catch(error => {
                console.error("Error al cargar las entradas", error);
            });
    },
    enable: id => entradasService.enable(id),
    disable: id => entradasService.disable(id)
}

function mostrarEntradas(entradas) {

    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < entradas.length; i++) {
         let e = entradas[i];

         let tr = document.createElement("tr");

         tr.innerHTML = `
            <td>${e.idEntrada}</td>
            <td>${e.nombreUsuario}</td>
            <td>${e.fechaHora}</td>
            <td>${e.idFuncion}</td>
            <td>${e.fechaHoraFuncion}</td>
            <td>${e.anulada === 0 ? "Activa" : "Cancelada"}</td>
            <td>
                <button id="btnHabilitarEntrada" type="button" data-id-entrada=${e.idEntrada} class="btn btn-success btnHabilitar me-2" ${e.anulada === 1 ? '' : 'disabled'}>Habilitar entrada</button>
                <button id="btnSuspenderEntrada" type="button" data-id-entrada=${e.idEntrada} class="btn btn-warning btnSuspender me-2" ${e.anulada === 0 ? '' : 'disabled'}>Suspender entrada</button>
            </td>
        `;
         //insertamos la fila a la tabla
         tabla.appendChild(tr);
    }

    
}