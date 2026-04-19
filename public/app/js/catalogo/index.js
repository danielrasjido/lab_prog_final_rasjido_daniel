import { catalogoController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () => {
    console.log("modulo catalogo index.js cargado");
    inicializarCatalogo();
});

async function inicializarCatalogo() {
    try {
        await catalogoController.listPeliculas({});
    } catch (error) {
        alert(error.message || "No se pudo cargar el catálogo.");
    }
}