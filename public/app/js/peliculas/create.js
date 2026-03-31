import { peliculasController } from "./controller.js";

document.addEventListener("DOMContentLoaded", event => {
    console.log("hola desde create.js")
    const form = document.getElementById("formPelicula");
    form.addEventListener("submit", (event) => {
        event.preventDefault(); 
        console.log("boton guardar presionado");
        peliculasController.save()
    });
})