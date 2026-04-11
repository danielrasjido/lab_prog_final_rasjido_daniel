import { salasService } from "./service.js";

export const salasController = {
    save: () => {
        const toastElement = document.getElementById("liveToast");
        const botonCrearSala = document.getElementById("btnCrearSala");
        const botonGuardarSala = document.getElementById("btnGuardarSalaToast");
        const inputCapacidad = document.getElementById("datoCapacidadSala");

        if (!toastElement || !botonCrearSala || !botonGuardarSala || !inputCapacidad) {
            return;
        }

        const toast = new bootstrap.Toast(toastElement);

        botonCrearSala.addEventListener("click", () => {
            inputCapacidad.value = "";
            toast.show();
        });

        botonGuardarSala.addEventListener("click", async () => {
            const capacidad = parseInt(inputCapacidad.value, 10);

            if (Number.isNaN(capacidad) || capacidad <= 0) {
                alert("Debes indicar una capacidad valida.");
                return;
            }

            try {
                await salasService.save({
                    capacidad,
                    estado: 1
                });
                toast.hide();
                await salasController.list({});
            } catch (error) {
                alert(error.message || "No se pudo guardar la sala.");
            }
        });
    },
    list: async (filters) => {
        try {
            const salas = await salasService.list(filters);
            mostrarSalas(salas);
        } catch (error) {
            alert(error.message || "No se pudieron cargar las salas.");
        }
    },
    enable: (idSala) => {
        return salasService.enable(idSala);
    },
    disable: (idSala) => {
        return salasService.disable(idSala);
    },
}

function mostrarSalas(salas) {
    const tablaSalas = document.getElementById("cuerpoDeLaTabla");
    if (!tablaSalas) return;
    tablaSalas.innerHTML = "";
    salas.forEach(sala => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${sala.idSala}</td>
            <td>${sala.capacidad}</td>
            <td>${sala.estado ? "Habilitada" : "Deshabilitada"}</td>
            <td>
                <button type="button" data-id-sala=${sala.idSala} class="btn btn-warning btnDeshabilitar" ${sala.estado ? 'Enabled' : 'Disabled'}>Deshabilitar</button>
                <button type="button" data-id-sala=${sala.idSala} class="btn btn-success btnHabilitar" ${sala.estado ? 'Disabled' : 'Enabled'}>Habilitar</button>
            </td>
        `;
        tablaSalas.appendChild(fila);
    });
}