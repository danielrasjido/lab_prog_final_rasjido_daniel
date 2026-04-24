import { funcionesController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("dom cargado modulo funciones");

    funcionesController.list();

    const btnGenerarPDF = document.getElementById("btnGenerarPDF");
    if (btnGenerarPDF) {
        btnGenerarPDF.addEventListener("click", () => {
            funcionesController.exportToPDF();
        });
    }

    const tabla = document.getElementById("cuerpoDeLaTabla");

    if (tabla) {
        tabla.addEventListener("click", (event) => {
            if (event.target.classList.contains("btnCancelar")) {
                const idFuncion = Number(event.target.dataset.idFuncion);
                funcionesController.cancelar(idFuncion)
                    .then(() => funcionesController.list())
                    .catch((error) => alert(error.message || "No se pudo cancelar la función."));
            }

            if (event.target.classList.contains("btnHabilitar")) {
                const idFuncion = Number(event.target.dataset.idFuncion);
                funcionesController.habilitar(idFuncion)
                    .then(() => funcionesController.list())
                    .catch((error) => alert(error.message || "No se pudo habilitar la función."));
            }
        });
    }
})