import { programacionService } from "./service.js";

export const programacionController = {
    save: () => {
        const toastElement = document.getElementById("liveToast");
        const botonCrearProgramacion = document.getElementById("btnCrearProgramacion");
        const botonGuardarProgramacionToast = document.getElementById("btnGuardarProgramacionToast");
        const inputFechaInicio = document.getElementById("datoFechaInicioProgramacion");
        const selectEstado = document.getElementById("datoEstadoProgramacion");

        if (!toastElement || !botonCrearProgramacion || !botonGuardarProgramacionToast || !inputFechaInicio || !selectEstado) {
            return;
        }

        const toast = new bootstrap.Toast(toastElement);

        botonCrearProgramacion.addEventListener("click", () => {
            inputFechaInicio.value = "";
            selectEstado.value = "3";
            toast.show();
        });

        botonGuardarProgramacionToast.addEventListener("click", async () => {
            const fechaInicioRaw = inputFechaInicio.value;
            const idEstadoProgramacion = parseInt(selectEstado.value, 10);

            if (!fechaInicioRaw) {
                alert("Debes indicar una fecha de inicio.");
                return;
            }

            const fechaInicio = new Date(`${fechaInicioRaw}T00:00:00`);
            const fechaFin = new Date(fechaInicio);

            if (idEstadoProgramacion === 4) {
                const diasHastaSabado = 6 - fechaInicio.getDay();
                fechaFin.setDate(fechaFin.getDate() + diasHastaSabado);
            } else {
                fechaFin.setDate(fechaFin.getDate() + 6);
            }

            const programacion = {
                fechaInicio: formatearFecha(fechaInicio),
                fechaFin: formatearFecha(fechaFin),
                idEstadoProgramacion
            };

            try {
                await guardarProgramacion(programacion);
                toast.hide();
                await programacionController.list({});
            } catch (error) {
                alert(error.message || "No se pudo guardar la programación.");
            }
        });
    },
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

    const estados = {
        1: "Cancelada",
        2: "Vigente",
        3: "Programada",
        4: "VigenteExcepcion"
    };

    for (let i = 0; i < programaciones.length; i++) {
        let p = programaciones[i];
        let tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${p.idProgramacion}</td>
            <td>${p.fechaInicio}</td>
            <td>${p.fechaFin}</td>
            <td>${estados[p.idEstadoProgramacion] ?? "Sin estado"}</td>
            <td>
                <button class="btn btn-primary" ${p.idEstadoProgramacion === 1 ? 'Disabled' : ''}>Modificar</button>
                <button type="button" data-id-pelicula=${p.idProgramacion} class="btn btn-warning btnEliminar" ${p.idEstadoProgramacion === 1 ? 'Disabled' : ''}>Cancelar</button>
            </td>
        `;
        tabla.appendChild(tr);
    }
}

async function guardarProgramacion(programacion) {
    try {
        await programacionService.save(programacion);
    } catch (error) {
        console.error("Error al guardar programación:", error);
        throw error;
    }
}

function formatearFecha(fecha) {
    const anio = fecha.getFullYear();
    const mes = String(fecha.getMonth() + 1).padStart(2, "0");
    const dia = String(fecha.getDate()).padStart(2, "0");
    return `${anio}-${mes}-${dia}`;
}