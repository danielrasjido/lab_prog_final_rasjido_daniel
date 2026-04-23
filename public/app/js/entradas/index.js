import { entradasController } from './controller.js'

document.addEventListener("DOMContentLoaded", ola => {
    console.log("dom cargado, modulo entradas")
    entradasController.list();

    const btnGenerarPDF = document.getElementById("btnGenerarPDF");
    if (btnGenerarPDF) {
        btnGenerarPDF.addEventListener("click", () => {
            entradasController.exportToPDF();
        });
    }


    //tabla
    let tabla = document.getElementById("cuerpoDeLaTabla");

    //suspender
    tabla.addEventListener("click", event =>{
        if(event.target.classList.contains("btnSuspender")){
            const idEntrada = parseInt(event.target.dataset.idEntrada)
            entradasController.disable(idEntrada).then(() => {
                entradasController.list()
            })
        }
    });
    

    //habilitar
    tabla.addEventListener("click", e => {
        if(e.target.classList.contains("btnHabilitar")){
            const idEntrada = parseInt(e.target.dataset.idEntrada);
            entradasController.enable(idEntrada).then(() => {
                entradasController.list()
            })
        }
    });
    
})