import { programacionController } from "./controller.js";
import { abrirInformeTabla } from "../shared/reportes.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("modulo programacion index.js cargado");
    programacionController.list({});
    programacionController.save();

    const btnGenerarPDF = document.getElementById("btnGenerarPDF");
    if (btnGenerarPDF) {
        btnGenerarPDF.addEventListener("click", () => {
            abrirInformeTabla({
                tableSelector: "#tablaProgramaciones",
                title: "Informe de programacion",
                excludeColumns: [4]
            });
        });
    }

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