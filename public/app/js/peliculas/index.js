import {peliculasController} from './controller.js';

document.addEventListener("DOMContentLoaded", event => {
    console.log("modulo peliculas index.js cargado")
    peliculasController.list({});
})