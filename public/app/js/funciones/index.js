import { funcionesController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("dom cargado modulo funciones");

    funcionesController.list();
})