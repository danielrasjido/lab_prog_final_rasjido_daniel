import { programacionService } from "./service.js";

export const programacionController = {
    list: async (filters) => {
        try {
            const programaciones = await programacionService.list(filters);
            mostrarProgramaciones(programaciones);
        } catch (error) {
            console.error("Error al listar programaciones:", error);
        }
    },
}

function mostrarProgramaciones(programaciones) {
    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < programaciones.length; i++) {
        let p = programaciones[i];
        let tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${p.idProgramacion}</td>
            <td>${p.fechaInicio}</td>
            <td>${p.fechaFin}</td>
            <td>
                <a href="peliculas/edit/${p.idProgramacion}" class="btn btn-primary">Modificar</a>
                <button type="button" data-id-pelicula=${p.idProgramacion} class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
        `;
        tabla.appendChild(tr);
    }
}