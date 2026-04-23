import { salasController } from "./controller.js";
import { abrirInformeTabla } from "../shared/reportes.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("modulo salas index.js cargado");
    salasController.list({});
    salasController.save();

    const btnGenerarPDF = document.getElementById("btnGenerarPDF");
    if (btnGenerarPDF) {
        btnGenerarPDF.addEventListener("click", () => {
            abrirInformeTabla({
                tableSelector: "#tablaSalas",
                title: "Informe de salas",
                excludeColumns: [3]
            });
        });
    }

    //tabla
    const tabla = document.getElementById("cuerpoDeLaTabla");

    //habilitar
    tabla.addEventListener("click", e => {
        if(e.target.classList.contains("btnHabilitar")){
            const idSala = parseInt(e.target.dataset.idSala);
            salasController.enable(idSala).then(() => {
                salasController.list({})
            })
        }
    });

    //boton deshabilitar
    tabla.addEventListener("click", e => {
        if(e.target.classList.contains("btnDeshabilitar")){
            const idSala = parseInt(e.target.dataset.idSala);
            salasController.disable(idSala).then(() => {
                salasController.list({})
            })
        }
        });

})