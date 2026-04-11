import { funcionesService } from "./service.js";

export const funcionesController = {
    list: async (filters = {}) => {
        try {
            const funciones = await funcionesService.list(filters);
            mostrarFunciones(funciones);
        } catch (error) {
            console.error("Error al listar funciones:", error);
            throw error;
        }
    },
}




function mostrarFunciones(funciones){
    console.log("mostrar funciones")
    let tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.innerHTML = '';

    for (let i = 0; i < funciones.length; i++) {
        console.log("bucle")
        console.log("mensaje bucle")
        console.log(i);
        //guardamos peli
        let f = funciones[i];
        //creamos fila :)
        let tr = document.createElement("tr");
        //modificamos el contenido de la fila
        tr.innerHTML = `
            <td>${f.idFuncion}</td>
            <td>${f.idProgramacion}</td>
            <td>${f.nombrePelicula}</td>
            <td>${f.idSala}</td>
            <td>${f.precio}</td>
            <td>${f.fecha}</td>
            <td>${f.hora}</td>
            <td>
                <a href="funciones/edit/${f.idPelicula}" class="btn btn-primary">Modificar</a>
                <button type="button" data-id-pelicula=${f.idPelicula} class="btn btn-danger btnEliminar">Eliminar</button>
            </td>
        `;
        //insertamos la fila a la tabla
        tabla.appendChild(tr);
    }

    
}