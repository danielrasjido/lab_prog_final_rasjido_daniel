import { funcionesController } from "./controller.js";

document.addEventListener("DOMContentLoaded", event => {
    console.log("dom cargaddo desde create.js del modulo funciones");
    funcionesController.initCreateForm();
    inicializarSelectorHora();
    const form = document.getElementById("formFuncion");
    form.addEventListener("submit", async (event) => {
        event.preventDefault(); 
        console.log("boton guardar presionado");
        try {
            await funcionesController.save();
        } catch (error) {
            alert(error.message || "No se pudo guardar la función.");
        }
    });
});

function inicializarSelectorHora() {
    const selectHora = document.getElementById("datoHoraHora");
    const selectMinuto = document.getElementById("datoHoraMinuto");
    const inputHora = document.getElementById("datoHora");

    if (!selectHora || !selectMinuto || !inputHora) {
        return;
    }

    for (let hora = 0; hora < 24; hora++) {
        const valor = String(hora).padStart(2, "0");
        const option = document.createElement("option");
        option.value = valor;
        option.textContent = valor;
        selectHora.appendChild(option);
    }

    const ahora = new Date();
    const horaActual = String(ahora.getHours()).padStart(2, "0");
    const minutoActual = ahora.getMinutes();
    const minutosPermitidos = [0, 15, 30, 45];
    const minutoCercano = minutosPermitidos.reduce((previo, actual) => {
        return Math.abs(actual - minutoActual) < Math.abs(previo - minutoActual) ? actual : previo;
    }, 0);

    selectHora.value = horaActual;
    selectMinuto.value = String(minutoCercano).padStart(2, "0");

    const sincronizarHora = () => {
        if (!selectHora.value || !selectMinuto.value) {
            inputHora.value = "";
            return;
        }

        inputHora.value = `${selectHora.value}:${selectMinuto.value}`;
    };

    selectHora.addEventListener("change", sincronizarHora);
    selectMinuto.addEventListener("change", sincronizarHora);

    sincronizarHora();
}