import { entradasController } from './controller.js'

document.addEventListener("DOMContentLoaded", ola => {
    console.log("dom cargado, modulo entradas")
    entradasController.list();
    
})