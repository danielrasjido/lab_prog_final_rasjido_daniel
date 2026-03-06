import { userController } from "./controller.js";

document.addEventListener("DOMContentLoaded", event => {
    console.log("dom cargado, edit.js");
    userController.load(1);
})