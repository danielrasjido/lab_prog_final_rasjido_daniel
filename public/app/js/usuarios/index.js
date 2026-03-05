//aca cargo el DOM, primero voy a hacer que los botones muestren un cartel y despues añado funcionalidad
import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", () =>{
    
    console.log("DOM cargado");

    userController.list();

});