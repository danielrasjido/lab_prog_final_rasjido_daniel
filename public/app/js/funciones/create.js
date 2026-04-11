import { funcionesController } from "./controller.js";

document.addEventListener("DOMContentLoaded", event => {
    console.log("dom cargaddo desde create.js del modulo funciones");
    funcionesController.initCreateForm();
    const form = document.getElementById("formFuncion");
    form.addEventListener("submit", async (event) => {
        event.preventDefault(); 
        console.log("boton guardar presionado");
        await funcionesController.save();
    });
})