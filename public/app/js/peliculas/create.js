import { peliculasController } from "./controller.js";

document.addEventListener("DOMContentLoaded", event => {
    console.log("hola desde create.js");
    peliculasController.initCreateForm();

    const form = document.getElementById("formPelicula");
    const btnGuardar = document.getElementById("btnGuardarPelicula");

    if (!form) {
        console.error("No se encontró el formulario formPelicula.");
        return;
    }

    const guardarPelicula = async () => {
        console.log("boton guardar presionado");
        try {
            await peliculasController.save();
        } catch (error) {
            console.error("Error al guardar película:", error.message || error);
        }
    };

    form.addEventListener("submit", async (event) => {
        event.preventDefault(); 
        await guardarPelicula();
    });

    if (btnGuardar) {
        btnGuardar.addEventListener("click", async () => {
            await guardarPelicula();
        });
    }
});