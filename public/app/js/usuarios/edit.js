import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", event => {
    console.log("dom cargado, edit.js");
    const url = window.location.pathname.split('/');
    const idUsuario = url[url.length - 1];
    userController.load(idUsuario);

    const botonValidarGuardar = document.querySelector("button[type=submit]");
    botonValidarGuardar.addEventListener("click", (event) =>{
        event.preventDefault();
        userController.update();
    })

    const botonEditar = document.getElementById("btnEditar");
    botonEditar.addEventListener("click", ()=>{
        userController.enableForm(true);
    })

    const botonCancelarEdicion = document.getElementById("btnCancelarEdicion");
    botonCancelarEdicion.addEventListener("click", () => {
        userController.enableForm(false);
        userController.resetForm();
    })

    const btnPDF = document.getElementById("btnExportarUsuarioPDF");
    btnPDF.addEventListener("click", () => {
        userController.exportUserToPDF();
    });

    const btnEliminarRegistro = document.getElementById("btnEliminarRegistro");
    btnEliminarRegistro.addEventListener("click", () => {
        userController.delete(idUsuario);
    });


})