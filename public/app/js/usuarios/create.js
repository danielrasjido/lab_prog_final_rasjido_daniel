import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("dom cargado en create.js")
    const form = document.getElementById("formUsuario");
    form.addEventListener("submit", (event) => {
        event.preventDefault(); 
        console.log("boton guardar presionado");
        guardarUsuario();
    });

 
});

function guardarUsuario(){
    userController.save();
}