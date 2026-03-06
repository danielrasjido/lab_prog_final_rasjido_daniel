//aca cargo el DOM, primero voy a hacer que los botones muestren un cartel y despues añado funcionalidad
import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () =>{
    
    console.log("DOM cargado");

    userController.list();

    //boton modificar

    const btnModificar = document.getElementById("btnModificar")

    //boton eliminar

    //en realidad, esto solo sirve si los botones no fueron cargados dinamicamente, pero fue buen intento 
    //onst botonesEliminar = document.querySelectorAll(".btnEliminar");
    //botonesEliminar.forEach()

    document.getElementById("cuerpoDeLaTabla").addEventListener("click", (e) =>{
        if(e.target.classList.contains("btnEliminar")){
            const idUsuario = parseInt(e.target.dataset.idUsuario);
            console.log("Boton presionado :), usuario: ", idUsuario);
        }
    });

    //boton pdf

    const btnPdf = document.getElementById("btnGenerarPDF");
    btnPdf.addEventListener("click", e => {
        userController.exportToPDF();
    })

    //boton buscar

    const btnBuscar = document.getElementById("btnBuscar");
    btnBuscar.addEventListener("click", () => {
        
        const perfil = document.getElementById("btnFiltrarPerfil").value;
        const estado = document.getElementById("btnFiltrarEstado").value;
        const busqueda = document.getElementById("datoBusqueda").value;
        
       
        

    
        
        userController.list(filters);
    })


});