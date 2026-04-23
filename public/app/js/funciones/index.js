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
})