import { peliculasController } from './controller.js';
import { abrirInformeTabla } from '../shared/reportes.js';

document.addEventListener("DOMContentLoaded", event => {
    console.log("modulo peliculas index.js cargado")
    peliculasController.list({});

    const btnGenerarPDF = document.getElementById("btnGenerarPDF");
    if (btnGenerarPDF) {
        btnGenerarPDF.addEventListener("click", () => {
            abrirInformeTabla({
                tableSelector: "#tablaPeliculas",
                title: "Informe de peliculas",
                excludeColumns: [15]
            });
        });
    }


    //boton eliminar
    document.getElementById("cuerpoDeLaTabla").addEventListener("click", (e) => {
        if (e.target.classList.contains("btnEliminar")) {
            const id = parseInt(e.target.dataset.idPelicula);
            peliculasController.delete(id)
            .then(() => peliculasController.list({}))
            .catch(err => alert(err.message || "No se pudo eliminar la película."));
        }
    });

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
            
            
            peliculasController.list(filters);
    })
})