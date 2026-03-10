import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    const boton = document.querySelector("button[type='submit']");
    boton.addEventListener("click", (event) => {
        event.preventDefault(); 
        guardarUsuario();
    });

 
});

function guardarUsuario(){
    userController.save();
}