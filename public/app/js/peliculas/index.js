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


    //boton deshabilitar
    document.getElementById("cuerpoDeLaTabla").addEventListener("click", (e) => {
        if (e.target.classList.contains("btnDeshabilitar")) {
            const id = parseInt(e.target.dataset.idPelicula);
            peliculasController.disable(id)
            .then(() => peliculasController.list({}))
            .catch(err => alert(err.message || "No se pudo deshabilitar la película."));
        }
    });

    //boton habilitar
    document.getElementById("cuerpoDeLaTabla").addEventListener("click", (e) => {
        if (e.target.classList.contains("btnHabilitar")) {
            const id = parseInt(e.target.dataset.idPelicula);
            peliculasController.enable(id)
            .then(() => peliculasController.list({}))
            .catch(err => alert(err.message || "No se pudo habilitar la película."));
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