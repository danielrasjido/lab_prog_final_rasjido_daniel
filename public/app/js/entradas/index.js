import { entradasController } from './controller'

document.addEventListener("DOMContentLoaded", ola => {
    console.log("dom cargado, modulo entradas")
    entradasController.list();
    
})