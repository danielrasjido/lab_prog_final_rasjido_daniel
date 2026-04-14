import { programacionController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("modulo programacion index.js cargado");
    programacionController.list({});
    programacionController.save();

    //botón cancelar prograamación 
    const tabla = document.getElementById("cuerpoDeLaTabla");
    tabla.addEventListener("click", e => {
        if(e.target.classList.contains("btnCancelarProgramacion")){
            const idProgramacion = parseInt(e.target.dataset.idProgramacion);
            console.log("boton cancelar programación presionado", idProgramacion);
            programacionController.cancelar(idProgramacion).then(() => {
                programacionController.list({})
            })
        }
    });
})