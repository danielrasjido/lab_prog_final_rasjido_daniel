import { programacionController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("modulo programacion index.js cargado");
    programacionController.list({});
})