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
            userController.delete(idUsuario);
            userController.list()
        }
    });

    //boton pdf

    const btnPdf = document.getElementById("btnGenerarPDF");
    btnPdf.addEventListener("click", e => {
        userController.exportToPDF();
    })

    //boton buscar

    const formBusqueda = document.getElementById("formBusqueda");
    formBusqueda.addEventListener("submit", (event) => {

        event.preventDefault();

        const texto = formBusqueda.querySelector('input[type="search"]').value.trim();
        
        const filters = {};

        if(texto != ""){
            filters.query = texto;
        }else{
            console.log("campo de busqueda vacio, se van a listar todos los usuarios");
        }
        
        
        userController.list(filters);
    })


});