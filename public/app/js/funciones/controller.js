import { funcionesService } from "./service.js";

export const funcionesController = {
    initCreateForm: async () => {
        try {
            const [peliculas, salas] = await Promise.all([
                funcionesService.listPeliculas({}),
                funcionesService.listSalas({ estado: 1 })
            ]);

            cargarSelectPeliculas(peliculas);
            cargarSelectSalas(salas);
        } catch (error) {
            console.error("Error al cargar películas y salas:", error);
            alert(error.message || "No se pudieron cargar las opciones del formulario.");
        }
    },
    list: async (filters = {}) => {
        try {
            const funciones = await funcionesService.list(filters);
            mostrarFunciones(funciones);
        } catch (error) {
            console.error("Error al listar funciones:", error);
            throw error;
        }
    },
    save: async () => {
        try {
            const funcion = capturarDatosFuncion();

            if (!funcion) {
                console.error("No se pudo capturar la función");
                return;
            }

            await funcionesService.save(funcion);
            alert("Función guardada con éxito.");
        } catch (error) {
            console.error("Error al guardar función:", error);
            throw error;
        }
    }
}




function mostrarFunciones(funciones) {
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

function cargarSelectPeliculas(peliculas) {
    const selectPelicula = document.getElementById("datoIdPelicula");
    if (!selectPelicula) return;

    selectPelicula.innerHTML = '<option value="">Seleccione una película</option>';

    peliculas.forEach((pelicula) => {
        const option = document.createElement("option");
        option.value = pelicula.idPelicula;
        option.textContent = pelicula.nombre;
        selectPelicula.appendChild(option);
    });
}

function cargarSelectSalas(salas) {
    const selectSala = document.getElementById("datoIdSala");
    if (!selectSala) return;

    selectSala.innerHTML = '<option value="">Seleccione una sala</option>';

    salas.forEach((sala) => {
        const option = document.createElement("option");
        option.value = sala.idSala;
        option.textContent = `Sala ${sala.idSala} (Capacidad: ${sala.capacidad})`;
        selectSala.appendChild(option);
    });
}

function capturarDatosFuncion() {

    const dtIdProgramacion = document.getElementById("datoIdProgramacion")?.value.trim();
    const dtIdPelicula = document.getElementById("datoIdPelicula")?.value.trim();
    const dtIdSala = document.getElementById("datoIdSala")?.value.trim();
    const dtPrecio = document.getElementById("datoPrecio")?.value.trim();
    const dtFecha = document.getElementById("datoFecha")?.value.trim();
    const dtHora = document.getElementById("datoHora")?.value.trim();

    if (!dtIdProgramacion || !dtIdPelicula || !dtIdSala || !dtPrecio || !dtFecha || !dtHora) {
        alert("Todos los campos son obligatorios.");
        return null;
    }

    let funcion = {
        idProgramacion: Number(dtIdProgramacion),
        idPelicula: Number(dtIdPelicula),
        idSala: Number(dtIdSala),
        precio: Number(dtPrecio),
        fecha: dtFecha,
        hora: dtHora
    };

    return funcion;
}